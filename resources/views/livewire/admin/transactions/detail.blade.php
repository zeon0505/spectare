<div class="p-6 sm:p-10">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-amber-500 drop-shadow-md">
                Detail Transaksi
            </h1>
            <p class="text-gray-400 mt-1">
                Detail lengkap untuk Order ID
                <span class="font-mono text-amber-400 bg-slate-800 px-2 py-1 rounded border border-slate-700">
                    #{{ $transaction->order_id }}
                </span>
            </p>
        </div>
        <a href="{{ route('admin.transactions.index') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-600 border border-slate-600 text-gray-200 text-sm font-medium rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Transaksi
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700">
                <div class="p-6 border-b border-slate-700">
                    <h2 class="text-xl font-semibold text-white">Informasi Pembayaran</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-400">Status</p>
                        <p class="text-lg font-bold">
                            <span @class([
                                'inline-flex items-center px-3 py-1 rounded-full text-sm font-bold',
                                'bg-green-500/10 text-green-400 border border-green-500/20' => $transaction->status == 'settlement' || $transaction->status == 'capture',
                                'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' => $transaction->status == 'pending',
                                'bg-red-500/10 text-red-400 border border-red-500/20' => $transaction->status == 'failure' || $transaction->status == 'expire' || $transaction->status == 'cancel',
                            ])>
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Total Pembayaran</p>
                        <p class="text-lg font-bold text-amber-500">
                            Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Metode Pembayaran</p>
                        <p class="text-lg font-semibold text-white">
                            {{ $transaction->payment_type ? Str::headline($transaction->payment_type) : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Tanggal Transaksi</p>
                        <p class="text-lg font-semibold text-white">
                            {{ $transaction->created_at ? $transaction->created_at->format('d F Y, H:i') : '-' }}
                        </p>
                    </div>
                </div>
            </div>

            @if($transaction->booking)
                <div class="mt-8 bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700">
                    <div class="p-6 border-b border-slate-700">
                        <h2 class="text-xl font-semibold text-white">Detail Tiket</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start">
                            <img src="{{ Str::startsWith($transaction->booking->showtime->film->poster_url, 'http') ? $transaction->booking->showtime->film->poster_url : Storage::url($transaction->booking->showtime->film->poster_url) }}" alt="{{ $transaction->booking->showtime->film->title }}" class="w-32 h-48 object-cover rounded-lg">
                            <div class="ml-6">
                                <h3 class="text-2xl font-bold text-white">{{ $transaction->booking->showtime->film->title }}</h3>
                                <p class="text-gray-400 text-sm mt-1">
                                    {{ $transaction->booking->showtime->film->genres->pluck('name')->join(', ') }}
                                </p>
                                <div class="mt-4 space-y-2 text-gray-300">
                                    <p><strong>Studio:</strong> {{ $transaction->booking->showtime->studio->name ?? '-' }}</p>
                                    <p><strong>Jadwal:</strong>
                                        @if($transaction->booking->showtime->show_date && $transaction->booking->showtime->start_time)
                                            {{ $transaction->booking->showtime->show_date->format('d M Y') }}, {{ $transaction->booking->showtime->start_time->format('H:i') }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                    <p><strong>Kursi:</strong>
                                        @foreach($transaction->booking->seats as $seat)
                                            <span class="font-mono bg-slate-700 px-2 py-1 rounded text-amber-400 border border-slate-600">{{ $seat->seat_number }}</span>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-8 bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-yellow-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <div>
                            <h2 class="text-xl font-semibold text-white">Data Booking Tidak Ditemukan</h2>
                            <p class="text-gray-400 mt-1">Tidak ada data booking yang terhubung dengan transaksi ini.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="space-y-8">
            @if($transaction->booking)
                <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700">
                    <div class="p-6 border-b border-slate-700">
                        <h2 class="text-xl font-semibold text-white">Informasi Pemesan</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-gray-400">Nama</p>
                        <p class="text-lg font-semibold text-white">{{ $transaction->booking->user->name ?? 'User tidak ditemukan' }}</p>
                        <p class="text-sm text-gray-400 mt-4">Email</p>
                        <p class="text-lg font-semibold text-white">{{ $transaction->booking->user->email ?? 'Email tidak ditemukan' }}</p>
                    </div>
                </div>
                <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700">
                    <div class="p-6 border-b border-slate-700">
                        <h2 class="text-xl font-semibold text-white">Kode Booking</h2>
                    </div>
                    <div class="p-6 flex justify-center">
                        @if($transaction->booking->qr_code)
                            <div class="bg-white p-4 rounded-lg">
                                {!! $transaction->booking->qr_code !!}
                            </div>
                        @else
                            <div class="text-center">
                                <p class="text-gray-400 mb-4">QR Code tidak tersedia.</p>
                                <button wire:click="generateQrCode" 
                                        class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded-lg transition-colors">
                                    Generate QR Code
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if(session()->has('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif
</div>
