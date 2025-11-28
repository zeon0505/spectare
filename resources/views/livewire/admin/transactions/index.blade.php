<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-4 sm:mb-0 drop-shadow-md">
            Daftar Transaksi
        </h1>
    </div>

    <div class="mb-4 flex justify-between">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Order ID, User, atau Film..." class="w-1/3 bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:border-amber-500/50">
        <select wire:model.live="status" class="bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-amber-500/50">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="settlement">Settlement</option>
            <option value="capture">Capture</option>
            <option value="failure">Failure</option>
            <option value="expire">Expire</option>
            <option value="cancel">Cancel</option>
        </select>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-700">

                <thead class="bg-slate-900">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Order ID
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            User
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Film
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-700">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-slate-700/30 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono text-sm text-gray-300 bg-slate-700 px-2 py-1 rounded border border-slate-600">
                                    #{{ $transaction->order_id }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-white">{{ $transaction->booking->user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ $transaction->booking->showtime->film->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-amber-500">
                                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span @class([
                                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                    'bg-green-500/10 text-green-400 border border-green-500/20' => $transaction->status == 'settlement' || $transaction->status == 'capture',
                                    'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' => $transaction->status == 'pending',
                                    'bg-red-500/10 text-red-400 border border-red-500/20' => $transaction->status == 'failure' || $transaction->status == 'expire' || $transaction->status == 'cancel',
                                ])>
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                {{ $transaction->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.transactions.detail', $transaction->id) }}" class="text-amber-500 hover:text-amber-400">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-16">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                    <p class="text-gray-400 text-lg font-medium">Belum ada transaksi.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-700 bg-slate-800">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
