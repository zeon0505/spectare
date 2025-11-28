<?php

namespace App\Livewire\Admin\Genres;

use App\Models\Genre;
use Livewire\Component;

class Create extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255|unique:genres,name',
    ];

    public function save()
    {
        $this->validate();

        Genre::create(['name' => $this->name]);

        session()->flash('success', 'Genre created successfully.');

        return redirect()->route('admin.genres.index');
    }

    public function render()
    {
        return view('livewire.admin.genres.create');
    }
}
