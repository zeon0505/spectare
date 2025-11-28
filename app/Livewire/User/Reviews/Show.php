<?php

namespace App\Livewire\User\Reviews;

use Livewire\Component;
use App\Models\Review;

class Show extends Component
{
    public $review;

    // Terima parameter {id} dari route
    public function mount($id)
    {
        $this->review = Review::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.user.reviews.show', [
            'review' => $this->review,
        ]);
    }
}
