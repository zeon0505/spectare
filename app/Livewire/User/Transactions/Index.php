<?php

namespace App\Livewire\User\Transactions;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $transactions = Transaction::whereHas('booking', function ($query) {
                                        $query->where('user_id', Auth::id());
                                    })
                                    ->with('booking.showtime.film', 'booking.showtime.studio')
                                    ->latest()
                                    ->paginate(10);

        return view('livewire.user.transactions.index', [
            'transactions' => $transactions,
        ]);
    }
}
