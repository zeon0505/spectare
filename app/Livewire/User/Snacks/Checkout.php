<?php

namespace App\Livewire\User\Snacks;

use Midtrans\Snap;
use Midtrans\Config;
use Livewire\Component;
use App\Models\Snack;
use App\Models\SnackOrder;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Checkout extends Component
{
    #[Layout('components.layouts.app')]
    public $cartItems = [];
    public $total = 0;
    public $snapToken;

    public function mount()
    {
        $this->cartItems = session()->get('cart', []);
        Log::info('Cart items on checkout mount: ', $this->cartItems);

        if (empty($this->cartItems)) {
            session()->flash('info', 'Your cart is empty.');
            return redirect()->route('user.snacks.index');
        }

        $this->calculateTotal();
        $this->createOrderAndGetSnapToken();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->cartItems as $item) {
            if (isset($item['snack']['price']) && isset($item['quantity'])) {
                $this->total += $item['snack']['price'] * $item['quantity'];
            }
        }
        Log::info('Calculated total: ' . $this->total);
    }

    public function createOrderAndGetSnapToken()
    {
        if ($this->total <= 0) {
            Log::error('Checkout attempted with zero or negative total.');
            session()->flash('error', 'Cannot proceed to payment with an empty cart.');
            return redirect()->route('user.cart.index');
        }

        // Create a new snack order
        $order = SnackOrder::create([
            'user_id' => Auth::id(),
            'total_price' => $this->total,
            'status' => 'pending',
        ]);
        Log::info('Created SnackOrder with ID: ' . $order->id);

        // Prepare items for Midtrans transaction details
        $midtransItems = [];
        foreach ($this->cartItems as $item) {
            // Create order items
            $order->items()->create([
                'snack_id' => $item['snack']['id'],
                'quantity' => $item['quantity'],
                'price' => $item['snack']['price'],
            ]);

            $midtransItems[] = [
                'id' => 'snack-' . $item['snack']['id'],
                'price' => (int) $item['snack']['price'],
                'quantity' => (int) $item['quantity'],
                'name' => $item['snack']['name'],
            ];
        }

        // Configure Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;



        // Create Midtrans transaction parameters
        $params = [
            'transaction_details' => [
                'order_id' => 'SNACK-' . substr($order->id, 0, 12) . '-' . time(), // Unique order ID
                'gross_amount' => (int) $this->total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'item_details' => $midtransItems,
            'callbacks' => [
                'finish' => route('user.snacks.index') // Redirect after payment
            ]
        ];

        Log::info('Midtrans params: ', $params);

        try {
            $this->snapToken = Snap::getSnapToken($params);
            Log::info('Successfully generated Snap Token: ' . $this->snapToken);
            // Clear the user's cart from session after creating the order
            session()->forget('cart');
            $this->dispatch('snackAdded'); // Update cart counter
        } catch (\Exception $e) {
            Log::error('Failed to create Snap Token: ' . $e->getMessage());
            session()->flash('error', 'Failed to create payment token: ' . $e->getMessage());
            return redirect()->route('user.cart.index');
        }
    }

    public function render()
    {
        return view('livewire.user.snacks.checkout');
    }
}
