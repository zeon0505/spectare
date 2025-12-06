<div wire:poll.3s="checkPaymentStatus" class="min-h-screen bg-slate-950 text-white">
    <div class="container mx-auto py-12 px-4">
        <div class="bg-slate-900 shadow-2xl shadow-black/50 rounded-2xl overflow-hidden max-w-4xl mx-auto border border-slate-800">
            <div class="p-8">
                <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">E-Ticket / Invoice</h1>
                        <p class="text-gray-400 text-sm">Booking ID: {{ $booking->id }}</p>
                    </div>
                    @if ($booking->status == 'paid' && $booking->qr_code_path)
                        <div class="text-right">
                            <div class="bg-white p-3 rounded-lg">
                                <img src="{{ asset('storage/' . $booking->qr_code_path) }}" alt="QR Code" class="w-32 h-32">
                            </div>
                        </div>
                    @elseif($paymentStatus !== 'paid')
                        <div class="text-right">
                            <div class="w-32 h-32 flex items-center justify-center bg-slate-800 rounded-lg border border-slate-700">
                                <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-amber-500"></div>
                            </div>
                            <p class="text-sm text-gray-400 mt-2">Waiting for payment...</p>
                        </div>
                    @endif
                </div>

                @if (session()->has('success'))
                    <div class="bg-green-900/30 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mt-6 backdrop-blur-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="bg-red-900/30 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mt-6 backdrop-blur-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($booking->status === 'pending' && app()->environment('local'))
                    <div class="mt-6 bg-yellow-900/20 border border-yellow-500/30 rounded-lg p-4 backdrop-blur-sm">
                        <p class="text-sm text-yellow-300 font-semibold mb-2">🧪 Development Mode</p>
                        <p class="text-sm text-yellow-200 mb-3">Simulate successful payment for local testing:</p>
                        <button wire:click="simulatePaymentSuccess" 
                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">
                            ✓ Simulate Payment Success
                        </button>
                    </div>
                @endif

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700/50">
                        <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                            </svg>
                            Movie Details
                        </h2>
                        <div class="space-y-3 text-gray-300">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Title:</span>
                                <span class="font-semibold text-white">{{ $booking->showtime->film->title }}</span>
                            </div>
                            <div class="h-px bg-slate-700"></div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Showtime:</span>
                                <span class="font-semibold text-white">{{ $booking->showtime->start_time->format('D, d M Y - H:i') }}</span>
                            </div>
                            <div class="h-px bg-slate-700"></div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Studio:</span>
                                <span class="font-semibold text-white">{{ $booking->showtime->studio->name }}</span>
                            </div>
                            <div class="h-px bg-slate-700"></div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Age Rating:</span>
                                <span class="font-semibold text-white">{{ $booking->showtime->film->age_rating }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700/50">
                        <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                            </svg>
                            Booking Details
                        </h2>
                        <div class="space-y-3 text-gray-300">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Seats:</span>
                                <span class="font-semibold text-amber-400">{{ $booking->seats->pluck('seat_number')->implode(', ') }} ({{ $booking->seats->count() }} tickets)</span>
                            </div>
                            <div class="h-px bg-slate-700"></div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Total Price:</span>
                                @if($booking->discount_amount > 0)
                                    <div class="flex flex-col items-end">
                                        <span class="text-gray-400 line-through text-xs">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </span>
                                        <span class="font-bold text-amber-500 text-lg">
                                            Rp {{ number_format($booking->total_price - $booking->discount_amount, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @else
                                    <span class="font-bold text-amber-500 text-lg">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <div class="h-px bg-slate-700"></div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400">Status:</span>
                                <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $booking->status == 'paid' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                            <div class="h-px bg-slate-700"></div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Payment Method:</span>
                                <span class="font-semibold text-white">{{ ucfirst($booking->transaction->payment_type ?? 'N/A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 border-t border-slate-700 pt-8">
                    <h3 class="text-lg font-semibold text-white mb-2 flex items-center">
                        <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Instructions
                    </h3>
                    <p class="text-gray-400 mt-2 leading-relaxed">
                        Please show this e-ticket (including the QR code) to the staff at the cinema entrance.
                    </p>
                </div>

                <div class="mt-6 flex justify-center">
                    <a href="{{ route('user.bookings.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-white font-semibold rounded-xl transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to My Bookings
                    </a>
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
