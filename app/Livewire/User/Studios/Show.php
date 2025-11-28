<?php

namespace App\Livewire\User\Studios;

use App\Models\Studio;
use Livewire\Component;

class Show extends Component
{
    public Studio $studio;

    public function mount(Studio $studio)
    {
        $this->studio = $studio->load('showtimes.film');
    }

    public function render()
    {
        return view('livewire.user.studios.show');
    }
}
