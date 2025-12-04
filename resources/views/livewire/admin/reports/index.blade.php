<div class="p-6 sm:p-10 bg-slate-950 min-h-screen">
    <div class="space-y-8">
        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-4xl font-black text-white drop-shadow-md mb-2">Laporan Penjualan</h1>
                <p class="text-gray-400">Analisis pendapatan dan transaksi tiket bioskop.</p>
            </div>
            
            <button wire:click="exportCsv" class="group flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-green-600/20 hover:scale-105 hover:shadow-green-600/40">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:-translate-y-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export CSV
            </button>
        </div>

        {{-- Filters Section --}}
        <div class="bg-slate-900 rounded-2xl shadow-2xl shadow-black/30 border border-slate-800 p-6">
            <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter Data
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Tanggal Mulai</label>
                    <input type="date" wire:model.live="startDate" 
                           class="w-full bg-slate-800 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all hover:border-slate-600">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Tanggal Selesai</label>
                    <input type="date" wire:model.live="endDate" 
                           class="w-full bg-slate-800 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all hover:border-slate-600">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Filter Film</label>
                    <div class="relative">
                        <select wire:model.live="selectedFilm" 
                                class="w-full bg-slate-800 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent appearance-none transition-all hover:border-slate-600">
                            <option value="">Semua Film</option>
                            @foreach($films as $film)
                                <option value="{{ $film->id }}">{{ $film->title }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Summary Card --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 to-purple-700 rounded-2xl p-8 shadow-2xl shadow-indigo-900/50 group">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
            
            <div class="relative flex justify-between items-center z-10">
                <div>
                    <p class="text-indigo-100 text-sm font-bold uppercase tracking-wider mb-1">Total Pendapatan (Periode Ini)</p>
                    <h3 class="text-4xl md:text-5xl font-black text-white drop-shadow-lg">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="p-4 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/20 shadow-inner group-hover:rotate-12 transition-transform duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="bg-slate-900 rounded-2xl shadow-2xl shadow-black/30 border border-slate-800 overflow-hidden">
            <div class="p-6 border-b border-slate-800 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white">Riwayat Transaksi</h3>
                <span class="text-sm text-gray-500">Menampilkan {{ $transactions->count() }} transaksi terbaru</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-800/50 border-b border-slate-700">
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">ID Transaksi</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Detail Film</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Kursi</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($transactions as $transaction)
                            <tr class="group hover:bg-slate-800/50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-mono text-amber-500 group-hover:text-amber-400 transition-colors">#{{ substr($transaction->id, 0, 8) }}...</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-white font-medium">{{ $transaction->created_at->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $transaction->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold text-white mr-3 border border-slate-600">
                                            {{ substr($transaction->user->name ?? 'G', 0, 1) }}
                                        </div>
                                        <div class="text-sm font-medium text-white">{{ $transaction->user->name ?? 'Guest' }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-white mb-1">{{ $transaction->booking->showtime->film->title ?? '-' }}</div>
                                    <div class="flex items-center text-xs text-gray-400">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        {{ $transaction->booking->showtime->studio->name ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $seats = json_decode($transaction->seats);
                                    @endphp
                                    @if(is_array($seats))
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($seats as $seat)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-800 text-gray-300 border border-slate-700">
                                                    {{ $seat }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-green-400">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wide
                                        {{ $transaction->status === 'success' ? 'bg-green-500/10 text-green-500 border border-green-500/20' : 
                                           ($transaction->status === 'pending' ? 'bg-yellow-500/10 text-yellow-500 border border-yellow-500/20' : 
                                           'bg-red-500/10 text-red-500 border border-red-500/20') }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-slate-800 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-white mb-1">Tidak ada data transaksi</h3>
                                        <p class="text-gray-500 text-sm">Coba ubah filter tanggal atau film.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($transactions->hasPages())
                <div class="px-6 py-4 border-t border-slate-800 bg-slate-900">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
