<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\SnackOrder;
use App\Models\Review;
use App\Models\Film;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]

class UserDashboard extends Component
{
    public $recentBookings;
    public $recentSnackOrders;
    public $recentReviews;
    public $nowShowingFilms;
    public $comingSoonFilms;

    public function mount()
    {
        $user = Auth::user();
        $this->recentBookings = Booking::where('user_id', $user->id)
            ->with('showtime.film', 'showtime.studio')
            ->latest()
            ->take(5)
            ->get();

        $this->recentSnackOrders = SnackOrder::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $this->recentReviews = Review::where('user_id', $user->id)
            ->with('film')
            ->latest()
            ->take(5)
            ->get();

        $this->nowShowingFilms = Film::where('status', 'Now Showing')
            ->latest()
            ->take(5)
            ->get();

        $this->comingSoonFilms = Film::where('status', 'Coming Soon')
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.user.user-dashboard');
    }
}
