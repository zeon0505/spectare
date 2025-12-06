<?php

namespace App\Livewire\Admin\Vouchers;

use App\Models\Voucher;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $vouchers = Voucher::query()
            ->when($this->search, function ($query) {
                $query->where('code', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.vouchers.index', compact('vouchers'))
            ->layout('components.layouts.app');
    }

    public function delete($id)
    {
        $voucher = Voucher::find($id);
        if ($voucher) {
            $voucher->delete();
            session()->flash('success', 'Voucher berhasil dihapus.');
        }
    }
}
