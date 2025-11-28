<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\SnackOrder;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Notification;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // --- DEBUGGING CODE START ---
        $debugData = "Notification received at: " . now()->toDateTimeString() . "\\n";
        $debugData .= "Request Body: " . $request->getContent() . "\\n\\n";
        Storage::disk('local')->append('midtrans_debug.txt', $debugData);
        // --- DEBUGGING CODE END ---

        Log::info('Midtrans notification received.', $request->all());

        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $notif = new Notification();

            $transactionStatus = $notif->transaction_status;
            $paymentType = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraudStatus = $notif->fraud_status;

            Log::info('Processing notification for Order ID: ' . $orderId, [
                'status' => $transactionStatus,
                'payment_type' => $paymentType,
                'fraud_status' => $fraudStatus
            ]);

            // Check if it's a snack order or a booking order
            if (Str::startsWith($orderId, 'SNACK-')) {
                // Handle Snack Order
                $orderParts = explode('-', $orderId);
                $snackOrderId = $orderParts[1];
                $order = SnackOrder::find($snackOrderId);

                if (!$order) {
                    return response()->json(['error' => 'Snack order not found'], 404);
                }

                if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                    $order->status = 'paid';
                } elseif ($transactionStatus == 'pending') {
                    $order->status = 'pending';
                } else { // deny, cancel, expire
                    $order->status = 'failed';
                }

                $order->save();

            } else {
                // Handle Booking Order
                $transaction = Transaction::where('payment_token', $orderId)->first();

               if (!$transaction) {
                    Log::error('Transaction not found for Order ID: ' . $orderId);
                    return response()->json(['error' => 'Transaction not found'], 404);
                }

                $booking = $transaction->booking;
                if (!$booking) {
                    return response()->json(['error' => 'Booking not found for this transaction'], 404);
                }

                if ($transactionStatus == 'capture') {
                    if ($paymentType == 'credit_card') {
                        if ($fraudStatus == 'challenge') {
                            $transaction->status = 'challenge';
                        } else {
                            $transaction->status = 'settlement'; // Use 'settlement' for consistency
                            $booking->status = 'paid';
                            Log::info('Booking status updated to paid for Booking ID: ' . $booking->id);


                            // Generate and save QR code
                            $qrCodeContent = (string) $booking->id;
                            $qrCodePath = 'qrcodes/' . $booking->id . '.svg';
                            $qrCodeImage = QrCode::format('svg')->size(200)->generate($qrCodeContent);
                            Storage::disk('public')->put($qrCodePath, $qrCodeImage);
                            $booking->qr_code_path = $qrCodePath;
                            Log::info('QR Code generated for Booking ID: ' . $booking->id, ['path' => $qrCodePath]);
                        }
                    }
                } elseif ($transactionStatus == 'settlement') {
                    $transaction->status = 'settlement';
                    $booking->status = 'paid';
                    Log::info('Booking status updated to paid for Booking ID: ' . $booking->id);

                    // Generate and save QR code
                    $qrCodeContent = (string) $booking->id;
                    $qrCodePath = 'qrcodes/' . $booking->id . '.svg';
                    $qrCodeImage = QrCode::format('svg')->size(200)->generate($qrCodeContent);
                    Storage::disk('public')->put($qrCodePath, $qrCodeImage);
                    $booking->qr_code_path = $qrCodePath;
                    Log::info('QR Code generated for Booking ID: ' . $booking->id, ['path' => $qrCodePath]);

                    // Kirim Email Konfirmasi
                    try {
                        Mail::to($booking->user->email)->send(new BookingConfirmation($booking));
                        Log::info('Booking confirmation email sent for Booking ID: ' . $booking->id);
                    } catch (\Exception $e) {
                        Log::error('Failed to send booking confirmation email for Booking ID: ' . $booking->id . ': ' . $e->getMessage());
                    }
                } elseif ($transactionStatus == 'pending') {
                    $transaction->status = 'pending';
                } elseif ($transactionStatus == 'deny') {
                    $transaction->status = 'deny';
                    $booking->status = 'cancelled';
                } elseif ($transactionStatus == 'expire') {
                    $transaction->status = 'expire';
                    $booking->status = 'cancelled';
                } elseif ($transactionStatus == 'cancel') {
                    $transaction->status = 'cancel';
                    $booking->status = 'cancelled';
                }

                $transaction->save();
                $booking->save();
            }

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: ' . $e->getMessage() . ' on line ' . $e->getLine() . ' in ' . $e->getFile());
            Storage::disk('local')->append('midtrans_debug.txt', "ERROR: " . $e->getMessage() . "\\n");
            return response()->json(['error' => 'Server Error'], 500);
        }
    }
}
