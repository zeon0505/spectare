<?php

namespace App\Livewire\User\Bookings;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('showtime.film')
            ->latest()
            ->paginate(10);

        return view('livewire.user.bookings.index', [
            'bookings' => $bookings,
        ]);
    }
}
