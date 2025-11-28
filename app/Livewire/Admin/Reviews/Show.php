<?php

namespace App\Livewire\Admin\Reviews;

use Livewire\Component;
use App\Models\Review;

class Show extends Component
{
    public $review;

    public function mount($id)
    {
        $this->review = Review::with(['user', 'film'])->findOrFail($id);
    }

    public function approve()
    {
        $this->review->update(['is_approved' => true]);
        session()->flash('message', 'Review berhasil disetujui!');
    }

    public function render()
    {
        return view('livewire.admin.reviews.show');
    }
}
