<?php

namespace App\Livewire\Admin\Genres;

use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(Genre $genre)
    {
        $genre->delete();

        session()->flash('success', 'Genre deleted successfully.');

        return redirect()->route('admin.genres.index');
    }

    public function render()
    {
        return view('livewire.admin.genres.index', [
            'genres' => Genre::paginate(10),
        ]);
    }
}
