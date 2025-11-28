<?php

namespace App\Livewire\User\Showtimes;

use App\Models\Film;
use Livewire\Component;

class Index extends Component
{
    public $filmsWithShowtimes;
    public $selectedDate;
    public $selectedFilm = 'all';

    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
        $this->loadShowtimes();
    }

    public function getFilmOptionsProperty()
    {
        return Film::whereHas('showtimes', function ($query) {
            $query->where('date', '>=', now()->startOfDay());
        })->orderBy('title')->get();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['selectedDate', 'selectedFilm'])) {
            $this->loadShowtimes();
        }
    }

    public function loadShowtimes()
    {
        $this->validate([
            'selectedDate' => 'required|date',
            'selectedFilm' => 'required',
        ]);

        $query = Film::with('genres')
            ->whereHas('showtimes', function ($q) {
                $q->where('date', $this->selectedDate);
            });

        if ($this->selectedFilm !== 'all') {
            $query->where('id', $this->selectedFilm);
        }

        $this->filmsWithShowtimes = $query->with(['showtimes' => function ($q) {
            $q->where('date', $this->selectedDate)->with('studio')->orderBy('time');
        }])->orderBy('title')->get();
    }

    public function render()
    {
        return view('livewire.user.showtimes.index', [
            'filmOptions' => $this->filmOptions,
        ]);
    }
}
