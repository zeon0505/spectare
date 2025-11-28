<?php

namespace App\Livewire\User\Snacks;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class ShoppingCart extends Component
{
    public $cartItems = [];
    public $total = 0;

    protected $listeners = ['snackAdded' => 'updateCart'];

    public function mount()
    {
        $this->updateCart();
    }

    public function updateCart()
    {
        $cart = session()->get('cart', []);

        // Filter out invalid items from the cart session
        $this->cartItems = array_filter($cart, function ($item) {
            return is_array($item) && isset($item['snack']) && isset($item['quantity']);
        });

        // If the cart had invalid items, update the session with the cleaned cart
        if (count($this->cartItems) !== count($cart)) {
            session()->put('cart', $this->cartItems);
        }

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cartItems)->reduce(function ($carry, $item) {
            // Ensure the item has the correct structure before calculating
            if (isset($item['snack']['price']) && isset($item['quantity'])) {
                return $carry + ($item['snack']['price'] * $item['quantity']);
            }
            return $carry;
        }, 0);
    }

    public function incrementQuantity($snackId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$snackId])) {
            $cart[$snackId]['quantity']++;
            session()->put('cart', $cart);
            $this->updateCart();
            $this->dispatch('snackAdded');
        }
    }

    public function decrementQuantity($snackId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$snackId])) {
            if ($cart[$snackId]['quantity'] > 1) {
                $cart[$snackId]['quantity']--;
            } else {
                unset($cart[$snackId]);
            }
            session()->put('cart', $cart);
            $this->updateCart();
            $this->dispatch('snackAdded');
        }
    }

    public function removeItem($snackId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$snackId]);
        session()->put('cart', $cart);
        $this->updateCart();
        $this->dispatch('snackAdded');
    }

    public function render()
    {
        return view('livewire.user.snacks.shopping-cart');
    }
}
