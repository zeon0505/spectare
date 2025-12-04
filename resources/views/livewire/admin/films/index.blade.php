<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-4 sm:mb-0 drop-shadow-md">
            Films Collection
        </h1>

        <a href="{{ route('admin.films.create') }}"
            class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-lg transition-all shadow-lg shadow-amber-500/20 hover:scale-105">
            + Tambah Film Baru
        </a>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 px-5 py-4 rounded-lg relative mb-8 shadow-md" role="alert">
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="md:col-span-3">
                <label for="search" class="block text-sm font-bold text-gray-400 mb-2">Search Films</label>
                <input type="text" id="search" wire:model.live.debounce.300ms="search"
                    class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                    placeholder="Cari judul film...">
            </div>

            <div>
                <label for="genre" class="block text-sm font-bold text-gray-400 mb-2">Genre</label>
                <select id="genre" wire:model.live="genre"
                    class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                    <option value="">All Genres</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-700">

                <thead class="bg-slate-900">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase w-[40%]">
                            Film
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Genre
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Rilis
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-700">
                    @forelse ($films as $film)
                        <tr wire:key="{{ $film->id }}" class="hover:bg-slate-700/30 transition-colors duration-200 group">

                            <td class="px-6 py-3">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-14 shadow-md rounded overflow-hidden border border-slate-600 group-hover:border-amber-500/50 transition-colors">
                                        <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" alt="{{ $film->title }}"
                                            class="object-cover w-full h-full">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-white group-hover:text-amber-500 transition-colors">{{ $film->title }}</div>
                                        <div class="text-xs text-gray-500">{{ $film->duration }} min</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-3 whitespace-nowrap">
                                @if ($film->genres->isNotEmpty())
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($film->genres->take(2) as $genre)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-700 text-gray-300 border border-slate-600">
                                                {{ $genre->name }}
                                            </span>
                                        @endforeach
                                        @if($film->genres->count() > 2)
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-slate-800 text-gray-500 border border-slate-700">
                                                +{{ $film->genres->count() - 2 }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-xs text-gray-500 italic">No Genre</span>
                                @endif
                            </td>

                            <td class="px-6 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ $film->release_date->format('d M Y') }}</div>
                            </td>

                            <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.films.edit', $film) }}"
                                        class="p-2 text-gray-400 hover:text-amber-500 hover:bg-amber-500/10 rounded-lg transition-all"
                                        title="Edit Film">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <button wire:click="delete({{ $film->id }})"
                                        wire:confirm="Anda yakin ingin menghapus film ini?"
                                        class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-all"
                                        title="Hapus Film">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                                    </svg>
                                    <p class="text-gray-400 text-lg font-medium">Belum ada film yang ditemukan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $films->links() }}
    </div>
</div>
