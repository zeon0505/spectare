<?php

namespace App\Livewire\Admin\Studios;

use App\Models\Studio;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function delete(Studio $studio)
    {
        $studio->delete();

        session()->flash('success', 'Studio deleted successfully.');

        return redirect()->route('admin.studios.index');
    }

    public function render()
    {
        $studios = Studio::query()
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->paginate(9);

        return view('livewire.admin.studios.index', [
            'studios' => $studios,
        ]);
    }
}
