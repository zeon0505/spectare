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
                        <th colspan="3" scope="row" class="px-3 py-5 text-right text-sm font-bold text-gray-300 uppercase tracking-wider sm:pl-8">Total</th>
                        <td class="whitespace-nowrap px-3 py-5 text-left text-xl font-black text-amber-500">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="mt-8 flex items-center justify-end gap-x-6">
        <button id="pay-button" type="button" 
            class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-900 font-bold py-3 px-8 rounded-xl shadow-lg shadow-amber-500/20 transition-all transform hover:scale-105 active:scale-95 flex items-center gap-2">
            Proceed to Payment
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

    @if ($snapToken)
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function(){
                // SnapToken acquired from previous step
                snap.pay('{{ $snapToken }}', {
                    // Optional
                    onSuccess: function(result){
                        /* You may add your own implementation here */
                        // alert("payment success!"); console.log(result);
                        window.location.href = "{{ route('user.snacks.index') }}";
                    },
                    // Optional
                    onPending: function(result){
                        /* You may add your own implementation here */
                        // alert("wating your payment!"); console.log(result);
                        window.location.href = "{{ route('user.snacks.index') }}";
                    },
                    // Optional
                    onError: function(result){
                        /* You may add your own implementation here */
                        // alert("payment failed!"); console.log(result);
                        window.location.href = "{{ route('user.cart.index') }}";
                    },
                    onClose: function() {
                        // alert('you closed the popup without finishing the payment');
                        window.location.href = "{{ route('user.cart.index') }}";
                    }
                });
            };

            // Automatically trigger the payment button click to open the modal
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('pay-button').click();
            });
        </script>
    @endif
</div>
