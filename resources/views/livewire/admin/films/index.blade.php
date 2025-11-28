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
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase w-1/3">
                            Poster & Judul
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Judul
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Genre
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Tanggal Rilis
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-700">
                    @forelse ($films as $film)
                        <tr wire:key="{{ $film->id }}" class="hover:bg-slate-700/30 transition-colors duration-200">

                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-12 h-20 shadow-md rounded overflow-hidden border border-slate-600">
                                        <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" alt="{{ $film->title }}"
                                            class="object-cover w-full h-full">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-white">{{ $film->title }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-300">{{ $film->title }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($film->genres->isNotEmpty())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-700 text-amber-500 border border-slate-600">
                                        {{ $film->genres->pluck('name')->join(', ') }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-500 italic">No Genre</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ $film->release_date->format('d M Y') }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-4">
                                    <a href="{{ route('admin.films.edit', $film) }}"
                                        class="text-amber-500 hover:text-white transition-colors font-semibold">
                                        Edit
                                    </a>
                                    <button wire:click="delete({{ $film->id }})"
                                        wire:confirm="Anda yakin ingin menghapus film ini?"
                                        class="text-red-500 hover:text-red-400 transition-colors font-semibold">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
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
