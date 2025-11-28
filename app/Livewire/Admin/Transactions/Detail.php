<?php

namespace App\Livewire\Admin\Transactions;

use Livewire\Component;
use App\Models\Transaction;


use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class Detail extends Component
{
    public Transaction $transaction;

    public function mount(Transaction $transaction)
    {
        $this->transaction = $transaction->load([
            'booking.user',
            'booking.showtime.film',
            'booking.showtime.studio',
            'booking.seats'
        ]);
    }

    public function generateQrCode()
    {
        $booking = $this->transaction->booking;

        if (!$booking || $booking->qr_code) {
            session()->flash('error', 'QR Code already exists or booking not found.');
            return;
        }

        try {
            // Generate QR code
            $qrCodeContent = (string) $booking->id;
            $qrCodeImage = QrCode::format('svg')->size(200)->generate($qrCodeContent);
            
            // Save as qr_code field (SVG content directly)
            $booking->qr_code = $qrCodeImage;
            $booking->save();

            // Reload the transaction to get updated booking
            $this->transaction->refresh();
            $this->transaction->load([
                'booking.user',
                'booking.showtime.film',
                'booking.showtime.studio',
                'booking.seats'
            ]);

            session()->flash('success', 'QR Code berhasil di-generate!');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal generate QR Code: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.transactions.detail');
    }
}
