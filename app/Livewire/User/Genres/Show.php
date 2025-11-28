<?php

namespace App\Livewire\User\Genres;

use Livewire\Component;
use App\Models\Genre;

class Show extends Component
{
    public $genre;

    public function mount($id)
    {
        $this->genre = Genre::with('films')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.user.genres.show', [
            'genre' => $this->genre,
            'films' => $this->genre->films
        ]);
    }
}
