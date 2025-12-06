<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="mb-10 text-center sm:text-left">
        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-300 drop-shadow-sm mb-3">
            Checkout
        </h1>
        <p class="text-gray-400 text-lg">
            Please review your order and proceed to payment.
        </p>
    </div>

    <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-800">
                <thead class="bg-slate-950/50">
                    <tr>
                        <th scope="col" class="py-5 pl-6 pr-3 text-left text-xs font-bold tracking-wider text-gray-400 uppercase sm:pl-8">Snack</th>
                        <th scope="col" class="px-3 py-5 text-left text-xs font-bold tracking-wider text-gray-400 uppercase">Price</th>
                        <th scope="col" class="px-3 py-5 text-left text-xs font-bold tracking-wider text-gray-400 uppercase">Quantity</th>
                        <th scope="col" class="px-3 py-5 text-left text-xs font-bold tracking-wider text-gray-400 uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse ($cartItems as $item)
                        <tr class="hover:bg-slate-800/50 transition-colors duration-200">
                            <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-bold text-white sm:pl-8">{{ $item['snack']['name'] }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-300">Rp {{ number_format($item['snack']['price'], 0, ',', '.') }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-300">{{ $item['quantity'] }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-bold text-amber-500">Rp {{ number_format($item['snack']['price'] * $item['quantity'], 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="whitespace-nowrap px-3 py-8 text-sm text-center text-gray-400">
                                Your cart is empty.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-slate-950/30 border-t border-slate-800">
                        <th colspan="3" scope="row" class="px-3 py-5 text-right text-sm font-bold text-gray-300 uppercase tracking-wider sm:pl-8">Subtotal</th>
                        <td class="whitespace-nowrap px-3 py-5 text-left text-lg font-bold text-gray-300">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                    @if($discountAmount > 0)
                    <tr class="bg-slate-950/30">
                        <th colspan="3" scope="row" class="px-3 py-2 text-right text-sm font-bold text-green-400 uppercase tracking-wider sm:pl-8">Discount</th>
                        <td class="whitespace-nowrap px-3 py-2 text-left text-lg font-bold text-green-400">-Rp {{ number_format($discountAmount, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    <tr class="bg-slate-950/50 border-t border-slate-800">
                        <th colspan="3" scope="row" class="px-3 py-5 text-right text-base font-black text-white uppercase tracking-wider sm:pl-8">Total Payment</th>
                        <td class="whitespace-nowrap px-3 py-5 text-left text-2xl font-black text-amber-500">Rp {{ number_format($finalTotal ?? $total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Voucher Input Section -->
    <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-xl border border-slate-800 p-6 mb-8 max-w-lg ml-auto">
        <label class="block text-sm font-medium text-gray-400 mb-2">Have a Voucher?</label>
        <div class="flex gap-2">
            <input wire:model="voucherCode" type="text" class="flex-1 bg-slate-800 border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-amber-500 uppercase" placeholder="Enter code">
            <button wire:click="applyVoucher" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded-lg transition-colors">Apply</button>
        </div>
        @error('voucherCode') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
        @if (session()->has('success_voucher'))
            <span class="text-green-400 text-sm mt-1 block">{{ session('success_voucher') }}</span>
        @endif

        @if($appliedVoucher)
            <div class="mt-3 flex justify-between items-center bg-indigo-900/30 border border-indigo-500/30 p-3 rounded-lg">
                <div>
                    <span class="font-bold text-amber-400">{{ $appliedVoucher->code }}</span>
                    <span class="text-xs text-gray-400 block">Discount Applied</span>
                </div>
                <button wire:click="removeVoucher" class="text-red-400 hover:text-red-300 text-sm hover:underline">Remove</button>
            </div>
        @endif
    </div>

    <div class="mt-8 flex items-center justify-end gap-x-6">
        <button wire:click="proceedToPayment" wire:loading.attr="disabled" type="button" 
            class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-900 font-bold py-3 px-8 rounded-xl shadow-lg shadow-amber-500/20 transition-all transform hover:scale-105 active:scale-95 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
            <span wire:loading.remove>Proceed to Payment</span>
            <span wire:loading>Processing...</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </button>
    </div>

    {{-- DEBUGGING: Display Snap Token Status --}}
    @if(config('app.debug'))
        <div class="mt-8 p-6 bg-slate-900 rounded-xl border border-slate-800">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Debug Info</h3>
            @if ($snapToken)
                <div class="flex items-center gap-2 text-green-400 mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-medium text-sm">Snap Token Generated</span>
                </div>
                <code class="block bg-slate-950 p-3 rounded-lg text-xs text-gray-400 font-mono break-all border border-slate-800">
                    {{ $snapToken }}
                </code>
            @else
                <div class="flex items-center gap-2 text-red-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    <span class="font-medium text-sm">Snap Token Not Found</span>
                </div>
            @endif
        </div>
    @endif
    {{-- END DEBUGGING --}}

    @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('open-midtrans-popup', (event) => {
                    if (event.token) {
                        window.snap.pay(event.token, {
                            onSuccess: function(result) {
                                window.location.href = "{{ route('user.snacks.index') }}?status=success";
                            },
                            onPending: function(result) {
                                window.location.href = "{{ route('user.snacks.index') }}?status=pending";
                            },
                            onError: function(result) {
                                window.alert("Payment failed!");
                            },
                            onClose: function() {
                                window.alert('You closed the popup without finishing the payment');
                            }
                        });
                    } else {
                        console.error('Snap token not received');
                        alert('Failed to initialize payment. Please try again.');
                    }
                });
            });
        </script>
    @endpush
</div>
