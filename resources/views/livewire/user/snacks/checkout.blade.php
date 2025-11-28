<div>
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">Checkout</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                    Please review your order and proceed to payment.
                </p>
            </div>
        </div>

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-white sm:pl-6">Snack</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Price</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Quantity</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-white dark:bg-gray-900">
                                @forelse ($cartItems as $item)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-white sm:pl-6">{{ $item['snack']['name'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-300">Rp {{ number_format($item['snack']['price'], 0, ',', '.') }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $item['quantity'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-300">Rp {{ number_format($item['snack']['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500 dark:text-gray-300">
                                            Your cart is empty.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="border-t border-gray-200 dark:border-gray-700">
                                    <th colspan="3" scope="row" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900 dark:text-white sm:pl-6">Total</th>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button id="pay-button" type="button" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Proceed to Payment
            </button>
        </div>

        {{-- DEBUGGING: Display Snap Token Status --}}
        <div class="mt-4 p-4 bg-gray-800 rounded-lg">
            @if ($snapToken)
                <p class="text-green-400">Debug Info: Snap Token ditemukan.</p>
                <p class="text-xs text-gray-400 break-all">Token: {{ $snapToken }}</p>
            @else
                <p class="text-red-400">Debug Info: Snap Token TIDAK ditemukan.</p>
            @endif
        </div>
        {{-- END DEBUGGING --}}

    </div>

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
