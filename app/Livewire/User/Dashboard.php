<?php

namespace App\Livewire\User;

use App\Models\Film;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        $nowShowingFilms = Film::where('status', 'Now Showing')
            ->with('genres')
            ->take(2)
            ->get();

        return view('livewire.user.dashboard', [
            'nowShowingFilms' => $nowShowingFilms,
        ]);
    }
}
