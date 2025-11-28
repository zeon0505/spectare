<?php

namespace App\Livewire\User\Bookings;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Detail extends Component
{
    public Booking $booking;
    public $paymentStatus;

    public function mount(Booking $booking)
    {
        $this->booking = $booking->load('showtime.film.genres', 'showtime.studio', 'seats', 'transaction');
        $this->paymentStatus = $this->booking->status;
    }

    public function checkPaymentStatus()
    {
        $this->booking->refresh();
        $this->paymentStatus = $this->booking->status;

        if ($this->paymentStatus === 'paid') {
            $this->dispatch('payment-successful');
        }
    }

    public function simulatePaymentSuccess()
    {
        // Only allow in development mode
        if (!app()->environment('local')) {
            session()->flash('error', 'This feature is only available in development mode.');
            return;
        }

        try {
            // Update transaction status
            $transaction = $this->booking->transaction;
            if ($transaction) {
                $transaction->status = 'success';
                $transaction->save();
            }

            // Update booking status
            $this->booking->status = 'paid';
            
            // Generate QR code
            $qrCodeContent = (string) $this->booking->id;
            $qrCodePath = 'qrcodes/' . $this->booking->id . '.svg';
            $qrCodeImage = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(200)->generate($qrCodeContent);
            \Illuminate\Support\Facades\Storage::disk('public')->put($qrCodePath, $qrCodeImage);
            $this->booking->qr_code_path = $qrCodePath;
            $this->booking->save();

            $this->paymentStatus = 'paid';
            
            session()->flash('success', 'Payment simulated successfully! QR code generated.');
            $this->dispatch('payment-successful');
        } catch (\Exception $e) {
            session()->flash('error', 'Simulation failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.user.bookings.detail');
    }
}
