<div class="px-6 py-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Voucher & Promo</h1>
            <p class="text-gray-400">Kelola kode promo dan diskon untuk pengguna.</p>
        </div>
        <a href="{{ route('admin.vouchers.create') }}" wire:navigate class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2 px-6 rounded-lg transition-all duration-300 flex items-center shadow-lg shadow-amber-500/20">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Buat Voucher Baru
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="mb-6">
        <div class="relative max-w-md">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari kode voucher..." class="w-full bg-slate-800 border border-slate-700 text-white rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all duration-300">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Voucher Table -->
    <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-900/50 border-b border-slate-700">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Tipe & Nominal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Usage</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Validity</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($vouchers as $voucher)
                        <tr class="hover:bg-slate-700/30 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-bold text-amber-500">{{ $voucher->code }}</span>
                                <div class="text-xs text-gray-400 mt-1">{{ Str::limit($voucher->description, 30) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($voucher->type == 'fixed')
                                    <span class="text-white font-semibold">Rp {{ number_format($voucher->amount, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-white font-semibold">{{ $voucher->amount }}%</span>
                                    <div class="text-xs text-gray-500">Max: Rp {{ number_format($voucher->max_discount, 0, ',', '.') }}</div>
                                @endif
                                <div class="text-xs text-gray-500 mt-1">Min. Belanja: Rp {{ number_format($voucher->min_purchase, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">Sisa: <span class="font-bold {{ $voucher->quota < 10 ? 'text-red-400' : 'text-green-400' }}">{{ $voucher->quota }}</span></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs text-gray-300">
                                    Start: {{ $voucher->start_date ? $voucher->start_date->format('d M Y') : 'Now' }}
                                </div>
                                <div class="text-xs text-gray-300">
                                    End: {{ $voucher->end_date ? $voucher->end_date->format('d M Y') : 'Forever' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(!$voucher->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-900/50 text-red-400 border border-red-800">Inactive</span>
                                @elseif(!$voucher->isValid())
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-900/50 text-orange-400 border border-orange-800">Invalid</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-900/50 text-green-400 border border-green-800">Active</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" wire:navigate class="text-amber-500 hover:text-amber-400 mr-3 transition-colors">Edit</a>
                                <button wire:click="delete('{{ $voucher->id }}')" wire:confirm="Yakin ingin menghapus voucher ini?" class="text-red-500 hover:text-red-400 transition-colors">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                <svg class="mx-auto h-12 w-12 text-gray-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                <p>Belum ada voucher yang dibuat.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-700 bg-slate-900/30">
            {{ $vouchers->links() }}
        </div>
    </div>
</div>
