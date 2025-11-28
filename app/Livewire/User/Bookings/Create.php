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
            // Use the consistently calculated total price
            $totalPrice = $this->showtime->film->ticket_price * count($this->selectedSeats);

            $booking = Booking::create([
                'user_id' => $user->id,
                'showtime_id' => $this->showtime->id,
                'booking_code' => 'BOOK-' . strtoupper(uniqid()),
                'total_price' => $totalPrice, // Use calculated price
                'status' => 'pending',
            ]);

            foreach ($this->selectedSeats as $seatNumber) {
                $booking->seats()->create(['seat_number' => $seatNumber]);
            }

            $orderId = 'TRX-' . substr($booking->id, 0, 15) . '-' . time();
            $transaction = Transaction::create([
                'booking_id' => $booking->id,
                'user_id' => $user->id,
                'amount' => $totalPrice,
                'transaction_date' => now(),
                'status' => 'pending',
                'payment_token' => $orderId,
            ]);

            // Setup Midtrans configuration
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');




            $midtrans_params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $totalPrice, // Use calculated price
                ],
                'customer_details' => [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $user->email,
                ],
                'item_details' => [[
                    'id' => $this->showtime->film->id,
                    'price' => $this->showtime->film->ticket_price,
                    'quantity' => count($this->selectedSeats),
                    'name' => 'Tickets for ' . $this->showtime->film->title
                ]],
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
