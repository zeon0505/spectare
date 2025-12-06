<?php

namespace App\Livewire\User\Bookings;

use App\Models\Booking;
use App\Models\Showtime;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Midtrans\Config;
use Midtrans\Snap;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

#[Layout('components.layouts.app')]
class Create extends Component
{
    public $showtime;
    public $selectedSeats;
    public $totalPrice;
    public $snapToken;
    public $filmDetails;
    
    // Voucher properties
    public $voucherCode;
    public $appliedVoucher = null;
    public $discountAmount = 0;
    public $finalTotal;

    public function mount(Showtime $showtime)
    {
        $this->showtime = $showtime->load('film.genres', 'studio');

        if (session()->has('booking_details')) {
            $bookingDetails = session('booking_details');
            $this->selectedSeats = $bookingDetails['seats'];
        }

        if (!$bookingDetails || $bookingDetails['showtime_id'] != $showtime->id) {
            return redirect()->route('user.films.index')->with('error', 'Detail pemesanan tidak ditemukan.');
        }

        $this->showtime = $showtime->load('film');
        $this->selectedSeats = $bookingDetails['seats'];
        $this->totalPrice = $bookingDetails['total_price'];
        $this->finalTotal = $this->totalPrice; // Initialize final total
    }

    public function applyVoucher()
    {
        $this->reset(['appliedVoucher', 'discountAmount']);
        $this->finalTotal = $this->totalPrice;

        if (empty($this->voucherCode)) {
            $this->addError('voucherCode', 'Harap masukkan kode voucher.');
            return;
        }

        $voucher = \App\Models\Voucher::where('code', $this->voucherCode)->active()->first();

        if (!$voucher || !$voucher->isValid()) {
            $this->addError('voucherCode', 'Kode voucher tidak valid atau sudah habis/kadaluarsa.');
            return;
        }

        if (!$voucher->isEligibleForUser(Auth::id())) {
            $this->addError('voucherCode', 'Anda sudah pernah menggunakan voucher ini sebelumnya.');
            return;
        }

        if ($this->totalPrice < $voucher->min_purchase) {
            $this->addError('voucherCode', 'Minimal pembelian untuk voucher ini adalah Rp ' . number_format($voucher->min_purchase, 0, ',', '.'));
            return;
        }

        // Calculate Discount
        if ($voucher->type === 'fixed') {
            $this->discountAmount = $voucher->amount;
        } else {
            $discount = ($this->totalPrice * $voucher->amount) / 100;
            if ($voucher->max_discount && $discount > $voucher->max_discount) {
                $discount = $voucher->max_discount;
            }
            $this->discountAmount = $discount;
        }

        // Ensure discount doesn't exceed total
        if ($this->discountAmount > $this->totalPrice) {
            $this->discountAmount = $this->totalPrice;
        }

        $this->finalTotal = $this->totalPrice - $this->discountAmount;
        $this->appliedVoucher = $voucher;

        session()->flash('success_voucher', 'Voucher berhasil digunakan! Hemat Rp ' . number_format($this->discountAmount, 0, ',', '.'));
    }

    public function removeVoucher()
    {
        $this->reset(['voucherCode', 'appliedVoucher', 'discountAmount']);
        $this->finalTotal = $this->totalPrice;
    }

    public function confirmBooking()
    {
        Log::info('confirmBooking method started.');

        $bookingDetails = session('booking_details');
        $user = Auth::user();

        // Split user's name for Midtrans customer details
        $nameParts = explode(' ', trim($user->name), 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? '';

        if (!$bookingDetails) {
            return redirect()->route('home')->with('error', 'Booking session expired. Please try again.');
        }

        // Validate ticket price before proceeding
        if (empty($this->showtime->film->ticket_price) || !is_numeric($this->showtime->film->ticket_price) || $this->showtime->film->ticket_price <= 0) {
            // Log the error for debugging
            \Illuminate\Support\Facades\Log::error('Invalid ticket price for film ID: ' . $this->showtime->film->id);

            // Return a user-friendly error
            session()->flash('error', 'The price for this film has not been set correctly. Price found: ' . $this->showtime->film->ticket_price);
            return redirect()->route('films.show', $this->showtime->film_id);
        }

        // Simplified seat availability check
        $bookedSeats = DB::table('booking_seats')
            ->join('bookings', 'booking_seats.booking_id', '=', 'bookings.id')
            ->where('bookings.showtime_id', $this->showtime->id)
            ->whereIn('bookings.status', ['confirmed', 'pending'])
            ->pluck('booking_seats.seat_number')->toArray();

        $conflictingSeats = array_intersect($this->selectedSeats, $bookedSeats);

        if (!empty($conflictingSeats)) {
            session()->flash('error', 'Sorry, the following seats are no longer available: ' . implode(', ', $conflictingSeats) . '. Please choose different seats.');
            return redirect()->route('films.show', $this->showtime->film_id);
        }

        DB::beginTransaction();
        try {
            // Use the consistently calculated total price AND applying voucher
            $baseTotal = $this->showtime->film->ticket_price * count($this->selectedSeats);
            
            // Re-validate voucher in case it expired while sitting on page
            $voucherId = null;
            $discountAmount = 0;
            $finalPrice = $baseTotal;

            if ($this->appliedVoucher) {
                // Refresh voucher instance to check quota constraints again in transaction
                $voucher = \App\Models\Voucher::where('id', $this->appliedVoucher->id)->lockForUpdate()->first();
                if ($voucher && $voucher->isValid()) {
                    $voucherId = $voucher->id;
                    $discountAmount = $this->discountAmount;
                    $finalPrice = $this->finalTotal;
                    
                    // Decrement quota
                    $voucher->decrement('quota');
                } else {
                    // Voucher no longer valid, fallback to normal price? 
                    // Or throw error? Better to throw error to inform user.
                    throw new \Exception("Voucher tidak lagi valid saat diproses.");
                }
            }

            $booking = Booking::create([
                'user_id' => $user->id,
                'showtime_id' => $this->showtime->id,
                'booking_code' => 'BOOK-' . strtoupper(uniqid()),
                'total_price' => $baseTotal, // Store base price
                'status' => 'pending',
                'voucher_id' => $voucherId, // Store voucher
                'discount_amount' => $discountAmount, // Store discount
            ]);

            foreach ($this->selectedSeats as $seatNumber) {
                $booking->seats()->create(['seat_number' => $seatNumber]);
            }

            $orderId = 'TRX-' . substr($booking->id, 0, 15) . '-' . time();
            $transaction = Transaction::create([
                'booking_id' => $booking->id,
                'user_id' => $user->id,
                'amount' => $finalPrice, // Transaction amount is the FINAL price
                'transaction_date' => now(),
                'status' => 'pending',
                'payment_token' => $orderId,
            ]);

            // Setup Midtrans configuration
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');




            // Prepare Midtrans items
            $midtransItems = [[
                'id' => $this->showtime->film->id,
                'price' => $this->showtime->film->ticket_price,
                'quantity' => count($this->selectedSeats),
                'name' => 'Tickets for ' . $this->showtime->film->title
            ]];

            if ($discountAmount > 0) {
                $midtransItems[] = [
                    'id' => 'voucher-discount',
                    'price' => -(int) $discountAmount,
                    'quantity' => 1,
                    'name' => 'Voucher Discount',
                ];
            }

            $midtrans_params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $finalPrice, // Use FINAL price
                ],
                'customer_details' => [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $user->email,
                ],
                'item_details' => $midtransItems,
            ];

            // Log the parameters being sent to Midtrans
            Log::info('Midtrans Params:', $midtrans_params);

            $snapToken = Snap::getSnapToken($midtrans_params);

            // HAPUS BARIS-BARIS YANG SALAH DI BAWAH INI
            // $transaction->payment_token = $snapToken;
            // $transaction->save();

            DB::commit();
            Log::info('DB committed.');

            session()->forget('booking_details');

            $this->dispatch('open-midtrans-popup', token: $snapToken, bookingId: $booking->id);

        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error for debugging
            Log::error('Payment Error: ' . $e->getMessage() . ' on line ' . $e->getLine() . ' in ' . $e->getFile(), ['trace' => $e->getTraceAsString()]);
            return back()->with('error', 'An error occurred while initiating payment. Please try again. ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.user.bookings.create');
    }
}
