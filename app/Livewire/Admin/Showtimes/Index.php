<?php

namespace App\Livewire\Admin\Showtimes;

use App\Models\Showtime;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(Showtime $showtime)
    {
        $showtime->delete();

        session()->flash('success', 'Showtime deleted successfully.');

        return redirect()->route('admin.showtimes.index');
    }

    public function render()
    {
        return view('livewire.admin.showtimes.index', [
            'showtimes' => Showtime::with(['film', 'studio'])->paginate(10),
        ]);
    }
}
