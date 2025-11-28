<?php

namespace App\Livewire\Admin\Genres;

use App\Models\Genre;
use Livewire\Component;

class Edit extends Component
{
    public Genre $genre;
    public $name;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:genres,name,' . $this->genre->id,
        ];
    }

    public function mount(Genre $genre)
    {
        $this->genre = $genre;
        $this->name = $genre->name;
    }

    public function update()
    {
        $this->validate();

        $this->genre->update(['name' => $this->name]);

        session()->flash('success', 'Genre updated successfully.');

        return redirect()->route('admin.genres.index');
    }

    public function render()
    {
        return view('livewire.admin.genres.edit');
    }
}
