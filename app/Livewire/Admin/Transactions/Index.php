<?php

namespace App\Livewire\Admin\Transactions;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';

    public function render()
    {
        $transactions = Transaction::with(['booking.user', 'booking.showtime.film'])
            ->when($this->search, function ($query) {
                $query->where('order_id', 'like', '%' . $this->search . '%')
                    ->orWhereHas('booking.user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('booking.showtime.film', function ($q) {
                        $q->where('title', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.transactions.index', [
            'transactions' => $transactions,
        ]);
    }
}
