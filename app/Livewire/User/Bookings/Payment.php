<?php

namespace App\Livewire\User\Bookings;

use App\Models\Transaction;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;

class Payment extends Component
{
    public Transaction $transaction;
    public $snapToken;

    public function mount(Transaction $transaction)
    {
        $this->transaction = $transaction->load('booking.film', 'booking.showtime.studio');
        $this->createSnapToken();
    }

    public function createSnapToken()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;



        $params = [
            'transaction_details' => [
                'order_id' => 'BOOK-' . substr($this->transaction->booking->id, 0, 13) . '-' . time(),
                'gross_amount' => (int) $this->transaction->total_price,
            ],
            'customer_details' => [
                'first_name' => $this->transaction->booking->user->name,
                'email' => $this->transaction->booking->user->email,
            ],
            'item_details' => [
                [
                    'id' => 'ticket-' . $this->transaction->booking->film->id,
                    'price' => (int) $this->transaction->booking->showtime->price,
                    'quantity' => count($this->transaction->booking->seats),
                    'name' => 'Tiket Film: ' . $this->transaction->booking->film->title,
                ]
            ],
            'callbacks' => [
                'finish' => route('user.bookings.detail', $this->transaction->booking->id)
            ]
        ];

        try {
            $this->snapToken = Snap::getSnapToken($params);
            $this->transaction->payment_token = $this->snapToken;
            $this->transaction->save();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal membuat token pembayaran: ' . $e->getMessage());
            return redirect()->route('user.bookings.index');
        }
    }

    public function render()
    {
        return view('livewire.user.bookings.payment');
    }
}
