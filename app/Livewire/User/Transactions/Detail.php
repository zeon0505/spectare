<?php

namespace App\Livewire\User\Transactions;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Detail extends Component
{
    public Transaction $transaction;

    public function mount($id)
    {
        $this->transaction = Transaction::where('id', $id)
            ->whereHas('booking', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with('booking.showtime.film', 'booking.showtime.studio', 'booking.seats')
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.user.transactions.detail');
    }
}
