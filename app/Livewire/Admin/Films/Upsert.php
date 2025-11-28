<?php

namespace App\Livewire\Admin\Films;

use App\Models\Film;
use App\Models\Genre;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Upsert extends Component
{
    use WithFileUploads;

    public ?Film $film;
    public $title;
    public $description;
    public $release_date;
    public $duration;
    public $status = 'Coming Soon';
    public $poster;
    public $trailer_url;
    public $ticket_price;
    public $age_rating;
    public $selectedGenres = [];

    public function mount(?Film $film)
    {
        $this->film = $film ?? new Film();

        if ($this->film->exists) {
            $this->title = $this->film->title;
            $this->description = $this->film->description;
            $this->release_date = $this->film->release_date->format('Y-m-d');
            $this->duration = $this->film->duration;
            $this->status = $this->film->status;
            $this->trailer_url = $this->film->trailer_url;
            $this->ticket_price = $this->film->ticket_price;
            $this->age_rating = $this->film->age_rating;
            $this->selectedGenres = $this->film->genres->pluck('id')->toArray();
        }
    }

    protected function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'status' => 'required|string',
            'trailer_url' => 'nullable|url',
            'ticket_price' => 'required|numeric|min:0',
            'age_rating' => 'required|string',
            'selectedGenres' => 'required|array|min:1',
            'selectedGenres.*' => 'exists:genres,id',
        ];

        $rules['poster'] = $this->film->exists ? 'nullable|image|max:2048' : 'required|image|max:2048';

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'release_date' => $this->release_date,
            'duration' => $this->duration,
            'age_rating' => $this->age_rating,
            'ticket_price' => $this->ticket_price,
            'status' => $this->status,
            'trailer_url' => $this->trailer_url,
        ];

        if ($this->poster) {
            if ($this->film->poster_url) {
                Storage::disk('public')->delete($this->film->poster_url);
            }
            $data['poster_url'] = $this->poster->store('posters', 'public');
        }

        if ($this->film->exists) {
            $this->film->update($data);
            $this->film->genres()->sync($this->selectedGenres);
            session()->flash('success', 'Film berhasil diperbarui');
        } else {
            $film = Film::create($data);
            $film->genres()->sync($this->selectedGenres);
            session()->flash('success', 'Film berhasil dibuat');
        }

        return redirect()->route('admin.films.index');
    }

    public function render()
    {
        return view('livewire.admin.films.upsert', [
            'genres' => Genre::all(),
        ]);
    }
}
