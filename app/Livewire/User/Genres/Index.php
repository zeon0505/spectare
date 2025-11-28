<?php

namespace App\Livewire\Admin\Genres;

use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        Genre::findOrFail($id)->delete();
        session()->flash('message', 'Genre berhasil dihapus.');
        // The component will re-render automatically, no need to refresh the list manually
    }

    public function render()
    {
        return view('livewire.admin.genres.index', [
            'genres' => Genre::latest()->paginate(10)
        ]);
    }
}
