<?php

namespace App\Livewire\Admin\Bookings;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Index extends Component
{
    use WithPagination;

    #[Layout('components.layouts.app')]
    public function render()
    {
        $bookings = Booking::with(['user', 'showtime.film'])->latest()->paginate(10);

        return view('livewire.admin.bookings.index', [
            'bookings' => $bookings,
        ]);
    }
}
