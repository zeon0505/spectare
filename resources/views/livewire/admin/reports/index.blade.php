<div class="p-8">
<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <h1 class="text-2xl font-bold text-white">Laporan Penjualan</h1>
        <button wire:click="exportCsv" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Export CSV
        </button>
    </div>

    <!-- Filters -->
    <div class="bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-700">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Tanggal Mulai</label>
                <input type="date" wire:model.live="startDate" class="w-full rounded-lg border-slate-600 bg-slate-700 text-white focus:ring-amber-500 focus:border-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Tanggal Selesai</label>
                <input type="date" wire:model.live="endDate" class="w-full rounded-lg border-slate-600 bg-slate-700 text-white focus:ring-amber-500 focus:border-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Filter Film</label>
                <select wire:model.live="selectedFilm" class="w-full rounded-lg border-slate-600 bg-slate-700 text-white focus:ring-amber-500 focus:border-amber-500">
                    <option value="">Semua Film</option>
                    @foreach($films as $film)
                        <option value="{{ $film->id }}">{{ $film->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Summary Card -->
    <div class="bg-indigo-600 rounded-xl p-6 text-white shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-indigo-200 text-sm font-medium">Total Pendapatan (Periode Ini)</p>
                <h3 class="text-3xl font-bold mt-1 text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>
            <div class="p-3 bg-indigo-500 rounded-lg bg-opacity-30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-slate-800 rounded-xl shadow-sm border border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Film</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Kursi</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-300">#{{ $transaction->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">
                                {{ $transaction->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-white">
                                {{ $transaction->user->name ?? 'Guest' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-300">
                                <div class="font-medium">{{ $transaction->booking->showtime->film->title ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $transaction->booking->showtime->studio->name ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-300">
                                @php
                                    $seats = json_decode($transaction->seats);
                                @endphp
                                {{ is_array($seats) ? implode(', ', $seats) : '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-white">
                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-900/30 text-green-400">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                Tidak ada data transaksi ditemukan untuk periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-700">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
</div>
