<?php

namespace App\Livewire\User\Snacks;

use Livewire\Component;

class CartIcon extends Component
{
    public $cartCount = 0;

    protected $listeners = ['snackAdded' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        $this->cartCount = collect(session()->get('cart', []))->sum('quantity');
    }

    public function render()
    {
        return view('livewire.user.snacks.cart-icon');
    }
}
