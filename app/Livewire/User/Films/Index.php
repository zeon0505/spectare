<?php

namespace App\Livewire\User\Films;

use App\Models\Film;
use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedGenre = '';

    protected $updatesQueryString = ['search', 'selectedGenre'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
        $this->selectedGenre = request()->query('selectedGenre', $this->selectedGenre);
    }

    public function render()
    {
        $films = Film::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedGenre, function ($query) {
                $query->whereHas('genres', function ($q) {
                    // INI ADALAH PERBAIKAN FINAL DAN DEFINITIF
                    $q->where('genres.id', $this->selectedGenre);
                });
            })
            ->paginate(12);

        return view('livewire.user.films.index', [
            'films' => $films,
            'genres' => Genre::all(),
        ]);
    }
}
