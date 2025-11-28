<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-4 sm:mb-0 drop-shadow-md">
            Manajemen User
        </h1>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <input wire:model.live.debounce.300ms="search" 
               type="text" 
               placeholder="Cari nama atau email..." 
               class="bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:border-amber-500/50">
        
        <select wire:model.live="roleFilter" 
                class="bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-amber-500/50">
            <option value="">Semua Role</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>

        <select wire:model.live="statusFilter" 
                class="bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-amber-500/50">
            <option value="">Semua Status</option>
            <option value="active">Active</option>
            <option value="blocked">Blocked</option>
        </select>
    </div>

    <!-- Users Table -->
    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-700">
                <thead class="bg-slate-900">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Terdaftar
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Bookings
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-700/30 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-white">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span @class([
                                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                    'bg-purple-500/10 text-purple-400 border border-purple-500/20' => $user->role == 'admin',
                                    'bg-blue-500/10 text-blue-400 border border-blue-500/20' => $user->role == 'user',
                                ])>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ $user->bookings_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span @class([
                                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                    'bg-green-500/10 text-green-400 border border-green-500/20' => !$user->is_blocked,
                                    'bg-red-500/10 text-red-400 border border-red-500/20' => $user->is_blocked,
                                ])>
                                    {{ $user->is_blocked ? 'Blocked' : 'Active' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <a href="{{ route('admin.users.detail', $user->id) }}" 
                                   class="text-amber-500 hover:text-amber-400">
                                    Detail
                                </a>
                                <button wire:click="toggleBlock({{ $user->id }})" 
                                        wire:confirm="Apakah Anda yakin ingin {{ $user->is_blocked ? 'unblock' : 'block' }} user ini?"
                                        class="{{ $user->is_blocked ? 'text-green-500 hover:text-green-400' : 'text-red-500 hover:text-red-400' }}">
                                    {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-16">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <p class="text-gray-400 text-lg font-medium">Tidak ada user ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-700 bg-slate-800">
            {{ $users->links() }}
        </div>
    </div>
</div>
