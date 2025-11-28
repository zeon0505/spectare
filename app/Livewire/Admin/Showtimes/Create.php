<?php

namespace App\Livewire\Admin\Showtimes;

use App\Models\Film;
use App\Models\Showtime;
use App\Models\Studio;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{
    public $film_id;
    public $studio_id;
    public $start_date;
    public $end_date;
    public $time;

    protected function rules()
    {
        return [
            'film_id' => 'required|exists:films,id',
            'studio_id' => 'required|exists:studios,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'time' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);

        if ($startDate->diffInDays($endDate) > 30) {
            $this->addError('end_date', 'The date range cannot be more than 30 days.');
            return;
        }

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            Showtime::create([
                'film_id' => $this->film_id,
                'studio_id' => $this->studio_id,
                'date' => $date->format('Y-m-d'),
                'time' => $this->time,
            ]);
        }

        session()->flash('success', 'Showtimes created successfully for the selected date range.');

        return redirect()->route('admin.showtimes.index');
    }

    public function render()
    {
        return view('livewire.admin.showtimes.create', [
            'films' => Film::all(),
            'studios' => Studio::all(),
        ]);
    }
}
