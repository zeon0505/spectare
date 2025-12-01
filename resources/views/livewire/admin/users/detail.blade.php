<div class="p-6 sm:p-10">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-amber-500 drop-shadow-md">
                Detail User
            </h1>
            <p class="text-gray-400 mt-1">
                Informasi lengkap untuk {{ $user->name }}
            </p>
        </div>
        <a href="{{ route('admin.users.index') }}" 
           class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-600 border border-slate-600 text-gray-200 text-sm font-medium rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar User
        </a>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- User Info Card -->
        <div class="lg:col-span-1">
            <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6">
                <h2 class="text-xl font-semibold text-white mb-4">Informasi User</h2>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-400">Nama</p>
                        <p class="text-lg font-semibold text-white">{{ $user->name }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-400">Email</p>
                        <p class="text-lg font-semibold text-white">{{ $user->email }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-400">Role</p>
                        <span @class([
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                            'bg-purple-500/10 text-purple-400 border border-purple-500/20' => $user->role == 'admin',
                            'bg-blue-500/10 text-blue-400 border border-blue-500/20' => $user->role == 'user',
                        ])>
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-400">Terdaftar</p>
                        <p class="text-lg font-semibold text-white">{{ $user->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-400">Status</p>
                        <span @class([
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                            'bg-green-500/10 text-green-400 border border-green-500/20' => !$user->is_blocked,
                            'bg-red-500/10 text-red-400 border border-red-500/20' => $user->is_blocked,
                        ])>
                            {{ $user->is_blocked ? 'Blocked' : 'Active' }}
                        </span>
                    </div>

                    @if($user->is_blocked)
                        <div>
                            <p class="text-sm text-gray-400">Blocked At</p>
                            <p class="text-sm text-white">{{ $user->blocked_at->format('d M Y, H:i') }}</p>
                        </div>
                        
                        @if($user->blockedBy)
                            <div>
                                <p class="text-sm text-gray-400">Blocked By</p>
                                <p class="text-sm text-white">{{ $user->blockedBy->name }}</p>
                            </div>
                        @endif
                    @endif
                </div>

                <button onclick="confirmBlockUser({{ $user->is_blocked ? 'true' : 'false' }})" 
                        class="mt-6 w-full px-4 py-2 {{ $user->is_blocked ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }} text-white font-semibold rounded-lg transition-colors">
                    {{ $user->is_blocked ? 'Unblock User' : 'Block User' }}
                </button>
            </div>
        </div>

        <!-- Activity History -->
        <div class="lg:col-span-2">
            <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700">
                <div class="border-b border-slate-700">
                    <nav class="flex space-x-4 px-6 py-4">
                        <button wire:click="setTab('bookings')" 
                                @class([
                                    'px-3 py-2 text-sm font-medium rounded-lg transition-colors',
                                    'bg-amber-500 text-slate-900' => $activeTab === 'bookings',
                                    'text-gray-400 hover:text-white hover:bg-slate-700' => $activeTab !== 'bookings',
                                ])>
                            Bookings ({{ $user->bookings->count() }})
                        </button>
                        <button wire:click="setTab('reviews')" 
                                @class([
                                    'px-3 py-2 text-sm font-medium rounded-lg transition-colors',
                                    'bg-amber-500 text-slate-900' => $activeTab === 'reviews',
                                    'text-gray-400 hover:text-white hover:bg-slate-700' => $activeTab !== 'reviews',
                                ])>
                            Reviews ({{ $user->reviews->count() }})
                        </button>
                        <button wire:click="setTab('transactions')" 
                                @class([
                                    'px-3 py-2 text-sm font-medium rounded-lg transition-colors',
                                    'bg-amber-500 text-slate-900' => $activeTab === 'transactions',
                                    'text-gray-400 hover:text-white hover:bg-slate-700' => $activeTab !== 'transactions',
                                ])>
                            Transactions ({{ $user->transactions->count() }})
                        </button>
                    </nav>
                </div>

                <div class="p-6">
                    @if($activeTab === 'bookings')
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase">Film</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase">Tanggal</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700">
                                    @forelse($user->bookings as $booking)
                                        <tr>
                                            <td class="px-4 py-3 text-sm text-white">{{ $booking->showtime->film->title }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-300">{{ $booking->created_at->format('d M Y') }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <span @class([
                                                    'px-2 py-1 rounded text-xs',
                                                    'bg-green-500/10 text-green-400' => $booking->status === 'paid',
                                                    'bg-yellow-500/10 text-yellow-400' => $booking->status === 'pending',
                                                ])>
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-amber-500">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-8 text-center text-gray-400">Belum ada booking.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @elseif($activeTab === 'reviews')
                        <div class="space-y-4">
                            @forelse($user->reviews as $review)
                                <div class="border border-slate-700 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-semibold text-white">{{ $review->film->title }}</h3>
                                        <div class="flex items-center">
                                            <span class="text-amber-500 mr-1">★</span>
                                            <span class="text-white">{{ $review->rating }}/5</span>
                                        </div>
                                    </div>
                                    <p class="text-gray-300 text-sm">{{ $review->comment }}</p>
                                    <p class="text-gray-500 text-xs mt-2">{{ $review->created_at->format('d M Y') }}</p>
                                </div>
                            @empty
                                <p class="text-center text-gray-400 py-8">Belum ada review.</p>
                            @endforelse
                        </div>
                    @elseif($activeTab === 'transactions')
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase">Order ID</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase">Film</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase">Amount</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700">
                                    @forelse($user->transactions as $transaction)
                                        <tr>
                                            <td class="px-4 py-3 text-sm font-mono text-gray-300">{{ $transaction->order_id ?? '-' }}</td>
                                            <td class="px-4 py-3 text-sm text-white">{{ $transaction->booking->showtime->film->title ?? '-' }}</td>
                                            <td class="px-4 py-3 text-sm text-amber-500">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <span @class([
                                                    'px-2 py-1 rounded text-xs',
                                                    'bg-green-500/10 text-green-400' => $transaction->status === 'success',
                                                    'bg-yellow-500/10 text-yellow-400' => $transaction->status === 'pending',
                                                ])>
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-300">{{ $transaction->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-4 py-8 text-center text-gray-400">Belum ada transaksi.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmBlockUser(isBlocked) {
    Swal.fire({
        title: isBlocked ? 'Unblock User' : 'Block User',
        text: isBlocked ? 'Apakah Anda yakin ingin unblock user ini?' : 'Apakah Anda yakin ingin block user ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: isBlocked ? '#10b981' : '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: isBlocked ? 'Ya, Unblock' : 'Ya, Block',
        cancelButtonText: 'Batal',
        background: '#1e293b',
        color: '#f1f5f9',
        customClass: {
            popup: 'border border-amber-500/20'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            @this.call('toggleBlock');
        }
    });
}
</script>
