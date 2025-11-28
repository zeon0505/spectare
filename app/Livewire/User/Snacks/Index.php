<?php

namespace App\Livewire\User\Snacks;

use App\Models\Snack;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.user.snacks.index', [
            'snacks' => Snack::latest()->paginate(8)
        ]);
    }

    public function addToCart(Snack $snack)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$snack->id])) {
            $cart[$snack->id]['quantity']++;
        } else {
            $cart[$snack->id] = [
                'snack' => $snack->toArray(),
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('snackAdded');
        session()->flash('success', 'Snack berhasil ditambahkan ke keranjang!');
    }
}
