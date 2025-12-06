<div class="px-6 py-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">{{ $voucherId ? 'Edit Voucher' : 'Buat Voucher Baru' }}</h1>
            <p class="text-gray-400">Atur detail voucher, diskon, dan masa berlaku.</p>
        </div>
        <a href="{{ route('admin.vouchers.index') }}" wire:navigate class="bg-slate-700 hover:bg-slate-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300">
            Kembali
        </a>
    </div>

    <div class="max-w-4xl bg-slate-800 rounded-xl border border-slate-700 p-8 shadow-xl">
        <form wire:submit="save" class="space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kode Voucher -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Kode Voucher</label>
                    <input wire:model="code" type="text" class="w-full bg-slate-900 border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-amber-500 uppercase placeholder-gray-600" placeholder="CONTOH: SUMMER25">
                    @error('code') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Tipe Diskon -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Tipe Diskon</label>
                    <select wire:model.live="type" class="w-full bg-slate-900 border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-amber-500">
                        <option value="fixed">Nominal Tetap (Rp)</option>
                        <option value="percent">Persentase (%)</option>
                    </select>
                </div>

                <!-- Jumlah Diskon -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        {{ $type === 'fixed' ? 'Nominal Diskon (Rp)' : 'Persentase Diskon (%)' }}
                    </label>
                    <input wire:model="amount" type="number" class="w-full bg-slate-900 border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-amber-500" placeholder="0">
                    @error('amount') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Maksimal Diskon (Only for Percent) -->
                @if($type === 'percent')
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Max. Potongan (Rp)</label>
                    <input wire:model="max_discount" type="number" class="w-full bg-slate-900 border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-amber-500" placeholder="Kosongkan jika unlimited">
                    <p class="text-xs text-gray-500 mt-1">Batas maksimal potongan harga.</p>
                </div>
                @endif

                <!-- Minimum Pembelian -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Min. Pembelian (Rp)</label>
                    <input wire:model="min_purchase" type="number" class="w-full bg-slate-900 border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-amber-500" placeholder="0">
                    <p class="text-xs text-gray-500 mt-1">Minimal total belanja agar voucher bisa dipakai.</p>
                </div>

                <!-- Kuota -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Kuota Voucher</label>
                    <input wire:model="quota" type="number" class="w-full bg-slate-900 border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-amber-500" placeholder="100">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-700/50">
                <!-- Start Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Mulai Berlaku</label>
                    <input wire:model="start_date" type="datetime-local" class="w-full bg-slate-900 border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-amber-500">
                </div>

                <!-- End Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Berakhir Pada</label>
                    <input wire:model="end_date" type="datetime-local" class="w-full bg-slate-900 border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-amber-500">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Deskripsi (Opsional)</label>
                <textarea wire:model="description" rows="3" class="w-full bg-slate-900 border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-amber-500" placeholder="Keterangan promo..."></textarea>
            </div>

            <!-- Status Toggle -->
            <div class="flex items-center">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:model="is_active" class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    <span class="ml-3 text-sm font-medium text-gray-300">Voucher Aktif</span>
                </label>
            </div>

            <div class="flex items-center justify-end pt-6 border-t border-slate-700">
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-3 px-8 rounded-lg shadow-lg shadow-amber-500/20 transform transition hover:scale-105 duration-200">
                    {{ $voucherId ? 'Simpan Perubahan' : 'Buat Voucher' }}
                </button>
            </div>
        </form>
    </div>
</div>
