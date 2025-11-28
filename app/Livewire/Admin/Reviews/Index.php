<?php

namespace App\Livewire\Admin\Reviews;

use Livewire\Component;
use App\Models\Review;
use Livewire\WithPagination; // Tambahkan ini

class Index extends Component
{
    use WithPagination; // Tambahkan ini

    public $search = '';

    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved' => true]);
    }

    public function unapprove($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved' => false]);
    }

    public function delete($id)
    {
        Review::findOrFail($id)->delete();
    }

    public function render()
    {
        $reviews = Review::with(['user', 'film'])
            ->where(function ($query) {
                $query->where('comment', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('film', function ($q) {
                        $q->where('title', 'like', '%' . $this->search . '%');
                    });
            })
            ->latest()
            ->paginate(10); // Ganti get() dengan paginate()

        return view('livewire.admin.reviews.index', [
            'reviews' => $reviews,
        ]);
    }
}
