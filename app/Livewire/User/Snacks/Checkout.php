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
    public $loading = false; // Add loading state

    // Voucher properties
    public $voucherCode;
    public $appliedVoucher = null;
    public $discountAmount = 0;
    public $finalTotal;

    public function mount()
    {
        $this->cartItems = session()->get('cart', []);
        Log::info('Cart items on checkout mount: ', $this->cartItems);

        if (empty($this->cartItems)) {
            session()->flash('info', 'Your cart is empty.');
            return redirect()->route('user.snacks.index');
        }

        $this->calculateTotal();
        $this->finalTotal = $this->total;
        // $this->createOrderAndGetSnapToken(); // REMOVED: Deferred until user clicks "Pay"
    }

    public function applyVoucher()
    {
        $this->reset(['appliedVoucher', 'discountAmount']);
        $this->finalTotal = $this->total;

        if (empty($this->voucherCode)) {
            $this->addError('voucherCode', 'Harap masukkan kode voucher.');
            return;
        }

        $voucher = \App\Models\Voucher::where('code', $this->voucherCode)->active()->first();

        if (!$voucher || !$voucher->isValid()) {
            $this->addError('voucherCode', 'Kode voucher tidak valid atau sudah habis/kadaluarsa.');
            return;
        }

        if (!$voucher->isEligibleForUser(Auth::id())) {
            $this->addError('voucherCode', 'Anda sudah pernah menggunakan voucher ini sebelumnya.');
            return;
        }

        if ($this->total < $voucher->min_purchase) {
            $this->addError('voucherCode', 'Minimal pembelian untuk voucher ini adalah Rp ' . number_format($voucher->min_purchase, 0, ',', '.'));
            return;
        }

        // Calculate Discount
        if ($voucher->type === 'fixed') {
            $this->discountAmount = $voucher->amount;
        } else {
            $discount = ($this->total * $voucher->amount) / 100;
            if ($voucher->max_discount && $discount > $voucher->max_discount) {
                $discount = $voucher->max_discount;
            }
            $this->discountAmount = $discount;
        }

        // Ensure discount doesn't exceed total
        if ($this->discountAmount > $this->total) {
            $this->discountAmount = $this->total;
        }

        $this->finalTotal = $this->total - $this->discountAmount;
        $this->appliedVoucher = $voucher;

        session()->flash('success_voucher', 'Voucher berhasil digunakan! Hemat Rp ' . number_format($this->discountAmount, 0, ',', '.'));
    }

    public function removeVoucher()
    {
        $this->reset(['voucherCode', 'appliedVoucher', 'discountAmount']);
        $this->finalTotal = $this->total;
    }

    public function proceedToPayment()
    {
        $this->loading = true;
        // Recalculate everything to be safe
        $this->calculateTotal();
        
        // Validate voucher again
        $voucherId = null;
        $discountAmount = 0;
        $finalPrice = $this->total;

        if ($this->appliedVoucher) {
            $voucher = \App\Models\Voucher::where('id', $this->appliedVoucher->id)->lockForUpdate()->first();
             if ($voucher && $voucher->isValid()) {
                $voucherId = $voucher->id;
                $discountAmount = $this->discountAmount;
                $finalPrice = $this->finalTotal;
                $voucher->decrement('quota');
            } else {
                $this->addError('voucherCode', 'Voucher tidak lagi valid.');
                $this->removeVoucher();
                $this->loading = false;
                return;
            }
        }
        
        $this->createOrderAndGetSnapToken($finalPrice, $voucherId, $discountAmount);
        $this->loading = false;
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

    public function createOrderAndGetSnapToken($finalPrice = null, $voucherId = null, $discountAmount = 0)
    {
        if ($this->total <= 0) {
            Log::error('Checkout attempted with zero or negative total.');
            session()->flash('error', 'Cannot proceed to payment with an empty cart.');
            return redirect()->route('user.cart.index');
        }

        $finalPrice = $finalPrice ?? $this->total;

        // Create a new snack order
        $order = SnackOrder::create([
            'user_id' => Auth::id(),
            'total_price' => $this->total, // Base price
            'status' => 'pending',
            'voucher_id' => $voucherId,
            'discount_amount' => $discountAmount,
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

        // Add discount as a negative item item if exists (Midtrans workaround for discount display)
        // OR simply adjust gross_amount and don't send item_details summed up check.
        // Midtrans requires item_details sum == gross_amount if item_details is present.
        // Simplest way: Add a negative value item "Discount"
        if ($discountAmount > 0) {
            $midtransItems[] = [
                'id' => 'voucher-discount',
                'price' => -(int) $discountAmount,
                'quantity' => 1,
                'name' => 'Voucher Discount',
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
                'gross_amount' => (int) $finalPrice,
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
            
            // Dispatch event to open popup
            $this->dispatch('open-midtrans-popup', token: $this->snapToken);
        } catch (\Exception $e) {
            Log::error('Failed to create Snap Token: ' . $e->getMessage());
            session()->flash('error', 'Failed to create payment token: ' . $e->getMessage());
            // return redirect()->route('user.cart.index'); // Don't redirect, let user retry
        }
    }

    public function render()
    {
        return view('livewire.user.snacks.checkout');
    }
}
