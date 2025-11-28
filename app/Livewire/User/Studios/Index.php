<?php

namespace App\Livewire\User\Studios;

use App\Models\Studio;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Cinema Studios')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $studios = Studio::query()
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->withCount('showtimes')
            ->paginate(6);

        return view('livewire.user.studios.index', [
            'studios' => $studios,
        ]);
    }
}
