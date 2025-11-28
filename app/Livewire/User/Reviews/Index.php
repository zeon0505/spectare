<?php

namespace App\Livewire\User\Reviews;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $reviews = Review::with(['user', 'film'])
            ->latest()
            ->paginate(5);

        return view('livewire.user.reviews.index', [
            'reviews' => $reviews,
        ]);
    }
}
