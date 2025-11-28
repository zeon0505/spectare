<?php

namespace App\Livewire\Film;

use App\Models\Film;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public Film $film;
    public $isInWishlist;

    public $reviews = [];
    public $newReview;
    public $newRating = 5;

    public function mount(Film $film)
    {
        $this->film = $film;
        dd($this->film->poster_url);
        $this->checkIfInWishlist();
    }

    public function checkIfInWishlist()
    {
        if (Auth::check()) {
            $this->isInWishlist = Wishlist::where('user_id', Auth::id())
                                          ->where('film_id', $this->film->id)
                                          ->exists();
        } else {
            $this->isInWishlist = false;
        }
    }

    public function toggleWishlist()
    {
        if (!Auth::check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        $wishlist = Wishlist::where('user_id', Auth::id())
                            ->where('film_id', $this->film->id)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $this->isInWishlist = false;
            session()->flash('message', 'Film telah dihapus dari wishlist.');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'film_id' => $this->film->id,
            ]);
            $this->isInWishlist = true;
            session()->flash('message', 'Film telah ditambahkan ke wishlist.');
        }
    }

    public function render()
    {
        return view('livewire.film.show');
    }
}
