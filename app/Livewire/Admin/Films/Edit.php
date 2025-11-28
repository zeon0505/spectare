<?php

namespace App\Livewire\Admin\Films;

use App\Models\Film;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Edit extends Component
{
    public Film $film;

    public function mount(Film $film)
    {
        $this->film = $film;
    }

    public function render()
    {
        return view('livewire.admin.films.edit');
    }
}
