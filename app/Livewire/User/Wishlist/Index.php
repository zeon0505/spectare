<?php

namespace App\Livewire\User\Wishlist;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->with('film')->get();
        return view('livewire.user.wishlist.index', [
            'wishlists' => $wishlists
        ]);
    }

    public function removeFromWishlist($wishlistId)
    {
        $wishlistItem = Wishlist::where('id', $wishlistId)->where('user_id', Auth::id())->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            session()->flash('message', 'Film removed from wishlist.');
        }
    }
}