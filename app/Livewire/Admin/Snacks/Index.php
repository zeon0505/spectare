<?php

namespace App\Livewire\Admin\Snacks;

use App\Models\Snack;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.snacks.index', [
            'snacks' => Snack::latest()->paginate(5)
        ]);
    }

    public function delete(Snack $snack)
    {
        $snack->delete();
        session()->flash('success', 'Snack deleted successfully!');
    }
}
