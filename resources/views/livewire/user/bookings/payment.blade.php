<div>
    <div class="container mx-auto py-8">
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-center mb-6">Complete Your Payment</h2>

            <div class="text-center mb-6">
                <p class="text-gray-700">You are about to pay for your booking. Please review the details below and click the button to proceed with the payment.</p>
            </div>

            <div id="snap-container" class="mb-6"></div>

            <button id="pay-button" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                Pay Now
            </button>
        </div>
    </div>

     @push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            const payButton = document.getElementById('pay-button');

            payButton.addEventListener('click', function () {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function (result) {
                        window.location.href = '{{ route("user.bookings.detail", $transaction->booking->id) }}';
                    },
                    onPending: function (result) {
                        alert("Waiting for your payment!");
                        console.log(result);
                    },
                    onError: function (result) {
                        alert("Payment failed!");
                        console.log(result);
                    },
                    onClose: function () {
                        alert('You closed the popup without finishing the payment.');
                    }
                });
            });

            .click();
        });
    </script>
    @endpush
</div>
