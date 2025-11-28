<?php

namespace App\Livewire\Admin\Showtimes;

use App\Models\Film;
use App\Models\Showtime;
use App\Models\Studio;
use Livewire\Component;

class Edit extends Component
{
    public Showtime $showtime;

    public $film_id;
    public $studio_id;
    public $date;
    public $time;

    protected function rules()
    {
        return [
            'film_id' => 'required|exists:films,id',
            'studio_id' => 'required|exists:studios,id',
            'date' => 'required|date',
            'time' => 'required',
        ];
    }

    public function mount(Showtime $showtime)
    {
        $this->showtime = $showtime;
        $this->film_id = $showtime->film_id;
        $this->studio_id = $showtime->studio_id;
        $this->date = $showtime->date->format('Y-m-d');
        $this->time = $showtime->time->format('H:i');
    }

    public function update()
    {
        $this->validate();

        $this->showtime->update([
            'film_id' => $this->film_id,
            'studio_id' => $this->studio_id,
            'date' => $this->date,
            'time' => $this->time,
        ]);

        session()->flash('success', 'Showtime updated successfully.');

        return redirect()->route('admin.showtimes.index');
    }

    public function delete()
    {
        $this->showtime->delete();

        session()->flash('success', 'Showtime deleted successfully.');

        return redirect()->route('admin.showtimes.index');
    }

    public function render()
    {
        return view('livewire.admin.showtimes.edit', [
            'films' => Film::all(),
            'studios' => Studio::all(),
        ]);
    }
}
