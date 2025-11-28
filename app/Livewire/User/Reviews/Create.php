<?php

namespace App\Livewire\User\Reviews;

use App\Models\Film;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public Film $film;
    public $rating = 0;
    public $comment = '';

    public function mount(Film $film)
    {
        $this->film = $film;
    }

    public function save()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);

        try {
            $review = Review::create([
                'user_id' => Auth::id(),
                'film_id' => $this->film->id,
                'rating' => $this->rating,
                'comment' => $this->comment,
                'is_approved' => false,
            ]);

            \Log::info('Review created successfully', [
                'review_id' => $review->id,
                'user_id' => Auth::id(),
                'film_id' => $this->film->id,
                'rating' => $this->rating,
            ]);

            session()->flash('success', 'Review submitted successfully and is awaiting approval.');

            return redirect()->route('user.films.show', $this->film->id);
        } catch (\Exception $e) {
            \Log::error('Failed to create review', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'film_id' => $this->film->id,
            ]);

            session()->flash('error', 'Failed to submit review. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.user.reviews.create');
    }
}
