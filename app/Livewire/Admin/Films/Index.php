<?php

namespace App\Livewire\Admin\Films;

use App\Models\Genre;
use Livewire\Component;
use App\Models\Film;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $genre = '';

    public function render()
    {
        $films = Film::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->genre, function ($query) {
                $query->whereHas('genres', function ($q) {
                    $q->where('genres.id', $this->genre);
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.films.index', [
            'films' => $films,
            'genres' => Genre::all(),
        ]);
    }

    public function delete(Film $film)
    {
        $film->delete();

        session()->flash('success', 'Film berhasil dihapus.');
    }
}
