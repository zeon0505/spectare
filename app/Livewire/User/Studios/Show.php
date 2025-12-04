<?php

namespace App\Livewire\User\Studios;

use App\Models\Studio;
use Livewire\Component;

class Show extends Component
{
    public Studio $studio;

    public function mount(Studio $studio)
    {
        $this->studio = $studio->load(['showtimes' => function ($query) {
            $query->where(function ($q) {
                $q->where('date', '>', now()->toDateString())
                  ->orWhere(function ($subQ) {
                      $subQ->where('date', '=', now()->toDateString())
                           ->where('time', '>', now()->format('H:i:s'));
                  });
            })
            ->orderBy('date')
            ->orderBy('time')
            ->with('film');
        }]);
    }

    public function render()
    {
        return view('livewire.user.studios.show');
    }
}
