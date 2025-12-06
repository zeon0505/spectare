<?php

namespace App\Livewire;

use App\Models\Film;
use Livewire\Component;

class Home extends Component
{
    public $nowShowingFilms;
    public $comingSoonFilms;

    public function mount()
    {
        $this->nowShowingFilms = Film::where('status', 'Now Playing')->get();
        $this->comingSoonFilms = Film::where('status', 'Coming Soon')->get();
    }

    public function render()
    {
        return view('livewire.home', [
            'nowShowingFilms' => $this->nowShowingFilms,
            'comingSoonFilms' => $this->comingSoonFilms,
        ]);
    }
}
