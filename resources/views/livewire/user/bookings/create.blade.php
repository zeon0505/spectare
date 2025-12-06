<div>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-white mb-6">Konfirmasi Pesanan</h1>

        @if(session()->has('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6">
            @if ($showtime)
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri: Detail Film & Jadwal -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-4 border-b border-gray-700 pb-2">{{ $showtime->film->title }}</h2>
                        <div class="flex items-center mb-4">
                            <img src="{{ Storage::disk('public')->url($showtime->film->poster_url) }}" alt="{{ $showtime->film->title }}" class="w-32 h-48 object-cover rounded-lg mr-4">
                            <div>
                                <p><strong>Jadwal:</strong> {{ \Carbon\Carbon::parse($showtime->date)->format('d M Y') }}, {{ \Carbon\Carbon::parse($showtime->time)->format('H:i') }}</p>
                                <p><strong>Studio:</strong> {{ $showtime->studio->name }}</p>
                                <p><strong>Harga Tiket:</strong> Rp {{ number_format($showtime->film->ticket_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Detail Pesanan -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-4 border-b border-gray-700 pb-2">Ringkasan Pesanan</h2>
                        <div class="space-y-2">
                            <p><strong>Kursi yang Dipilih:</strong></p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($selectedSeats as $seat)
                                    <span class="bg-indigo-500 text-white px-3 py-1 rounded-full text-sm">{{ $seat }}</span>
                                @endforeach
                            </div>
                            <p class="mt-2"><strong>Jumlah Tiket:</strong> {{ count($selectedSeats) }}</p>
                            
                            <!-- Voucher Section -->
                            <div class="mt-4 pt-4 border-t border-gray-700">
                                <label class="block text-sm font-medium mb-2">Kode Voucher</label>
                                <div class="flex space-x-2">
                                    <input wire:model="voucherCode" type="text" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 uppercase" placeholder="Masukkan kode">
                                    <button wire:click="applyVoucher" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg text-sm px-4 py-2">Gunakan</button>
                                </div>
                                @error('voucherCode') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                @if (session()->has('success_voucher'))
                                    <span class="text-green-400 text-xs mt-1 block">{{ session('success_voucher') }}</span>
                                @endif

                                @if($appliedVoucher)
                                    <div class="mt-2 text-sm bg-indigo-900/50 p-2 rounded flex justify-between items-center border border-indigo-700">
                                        <span>
                                            <span class="font-bold text-amber-400">{{ $appliedVoucher->code }}</span> applied
                                        </span>
                                        <button wire:click="removeVoucher" class="text-red-400 hover:text-red-300 text-xs underline">Hapus</button>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-700 space-y-1">
                                <div class="flex justify-between">
                                    <span>Subtotal:</span>
                                    <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                                </div>
                                @if($discountAmount > 0)
                                    <div class="flex justify-between text-green-400">
                                        <span>Diskon:</span>
                                        <span>-Rp {{ number_format($discountAmount, 0, ',', '.') }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between text-lg font-bold border-t border-gray-700 pt-2 mt-2">
                                    <span>Total Bayar:</span>
                                    <span class="text-amber-400">Rp {{ number_format($finalTotal ?? $totalPrice, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p>Detail pesanan tidak ditemukan. Silakan coba lagi.</p>
            @endif
        </div>

        <div class="mt-8 text-center">
            <button wire:click="confirmBooking" wire:loading.attr="disabled" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-3 px-8 rounded-lg disabled:bg-slate-600 disabled:cursor-not-allowed transition-colors">
                <span wire:loading.remove>Confirm & Pay</span>
                <span wire:loading>Processing...</span>
            </button>
        </div>

        @if (session()->has('error'))
            <div class="mt-4 bg-red-900/50 border border-red-700 text-red-300 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    @push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('open-midtrans-popup', (event) => {
                if (event.token) {
                    window.snap.pay(event.token, {
                        onSuccess: function(result) {
                            window.location.href = "{{ route('user.bookings.index') }}?status=success";
                        },
                        onPending: function(result) {
                            window.location.href = "{{ route('user.bookings.index') }}?status=pending";
                        },
                        onError: function(result) {
                            window.location.reload();
                        },
                        onClose: function() {
                            alert('Anda menutup jendela pembayaran sebelum selesai.');
                            window.location.reload();
                        }
                    });
                } else {
                    console.error('Snap token tidak diterima.');
                    alert('Gagal memuat halaman pembayaran. Silakan coba lagi.');
                }
            });
        });
    </script>
    @endpush
</div>
