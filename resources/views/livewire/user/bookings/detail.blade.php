<div wire:poll.3s="checkPaymentStatus">
    <div class="container mx-auto py-12">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden max-w-4xl mx-auto">
            <div class="p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">E-Ticket / Invoice</h1>
                        <p class="text-gray-500 dark:text-gray-400">Booking ID: {{ $booking->id }}</p>
                    </div>
                    @if ($booking->status == 'paid' && $booking->qr_code_path)
                        <div class="text-right">
                            <img src="{{ asset('storage/' . $booking->qr_code_path) }}" alt="QR Code" class="w-32 h-32">
                        </div>
                    @elseif($paymentStatus !== 'paid')
                        <div class="text-right">
                            <div class="w-32 h-32 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg">
                                <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-amber-500"></div>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Waiting for payment...</p>
                        </div>
                    @endif
                </div>

                @if (session()->has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($booking->status === 'pending' && app()->environment('local'))
                    <div class="mt-4 bg-yellow-50 border border-yellow-300 rounded-lg p-4">
                        <p class="text-sm text-yellow-800 font-semibold mb-2">🧪 Development Mode</p>
                        <p class="text-sm text-yellow-700 mb-3">Simulate successful payment for local testing:</p>
                        <button wire:click="simulatePaymentSuccess" 
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition">
                            ✓ Simulate Payment Success
                        </button>
                    </div>
                @endif

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Movie Details</h2>
                        <div class="space-y-3">
                            <p><strong>Title:</strong> {{ $booking->showtime->film->title }}</p>
                            <p><strong>Showtime:</strong> {{ $booking->showtime->start_time->format('D, d M Y - H:i') }}
                            </p>
                            <p><strong>Studio:</strong> {{ $booking->showtime->studio->name }}</p>
                            <p><strong>Age Rating:</strong> {{ $booking->showtime->film->age_rating }}</p>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Booking Details</h2>
                        <div class="space-y-3">
                            <p><strong>Seats:</strong> {{ $booking->seats->pluck('seat_number')->implode(', ') }}
                                ({{ $booking->seats->count() }} tickets)</p>
                            <p><strong>Total Price:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </p>
                            <p><strong>Status:</strong> <span
                                    class="px-3 py-1 text-sm font-semibold rounded-full {{ $booking->status == 'paid' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">{{ ucfirst($booking->status) }}</span>
                            </p>
                            <p><strong>Payment Method:</strong>
                                {{ ucfirst($booking->transaction->payment_type ?? 'N/A') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 border-t pt-8">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Instructions</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">
                        Please show this e-ticket (including the QR code) to the staff at the cinema entrance.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('payment-successful', () => {
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        });
    });
</script>
@endpush
