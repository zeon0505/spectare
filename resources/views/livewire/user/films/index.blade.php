<main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8" wire:poll.10s>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-amber-500">Films Collection</h1>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2" for="search">
                    Search Films
                </label>
                <div class="relative">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Enter film title..."
                        id="search"
                        class="shadow-sm appearance-none border border-slate-700 bg-slate-900 rounded-md w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder:text-gray-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2" for="genre">
                    Genre
                </label>
                <select wire:model.live="selectedGenre" id="genre"
                    class="shadow-sm appearance-none border border-slate-700 bg-slate-900 rounded-md w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                    <option value="" class="bg-slate-800">All Genres</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" class="bg-slate-800">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-slate-700">
            <thead class="bg-slate-900">
                <tr>
                    <th scope="col"
                        class="w-2/5 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                        Poster
                    </th>
                    <th scope="col"
                        class="w-1/5 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                        Judul
                    </th>
                    <th scope="col"
                        class="w-1/5 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                        Genre
                    </th>
                    <th scope="col"
                        class="w-1/5 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                        Tanggal Rilis
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse ($films as $film)
                    <tr wire:key="{{ $film->id }}">

                        {{-- Kolom Poster & Judul --}}
                        <td class="px-6 py-4"> {{-- Hapus whitespace-nowrap dari sini --}}
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-20">
                                    <img src="{{ asset('storage/' . $film->poster_url) }}" alt="{{ $film->title }}"
                                        class="object-cover w-12 h-20 rounded">
                                </div>
                                <div class="ml-3">
                                    {{-- Izinkan judul wrap jika terlalu panjang --}}
                                    <div class="text-sm font-medium text-gray-100">{{ $film->title }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Kolom Judul Terpisah (jika ingin tetap ada) --}}
                        <td class="px-6 py-4"> {{-- Hapus whitespace-nowrap dari sini --}}
                            <div class="text-sm font-medium text-gray-100">{{ $film->title }}</div>
                        </td>

                        {{-- Kolom Genre --}}
                        <td class="px-6 py-4 text-sm text-gray-400">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($film->genres as $genre)
                                    <span class="inline-block bg-slate-700 rounded-full px-2 py-1 text-xs font-semibold text-gray-300">
                                        {{ $genre->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>

                        {{-- Kolom Tanggal Rilis --}}
                        <td class="px-6 py-4 text-sm text-gray-400 whitespace-nowrap">
                            {{ $film->release_date->format('d M Y') }}
                        </td>

                       {{-- Kolom Actions --}}
                         <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                            <a href="{{ route('user.films.show', $film) }}"
                                class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2 px-4 rounded-lg text-xs transition-all shadow-md">
                                View Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                <p class="mt-2 text-sm font-medium text-gray-300">No films found</p>
                                <p class="mt-1 text-sm text-gray-500">
                                    @if ($search || $selectedGenre)
                                        Try adjusting your search or filter.
                                    @else
                                        There are currently no films to display.
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($films->hasPages())
        <div class="mt-6">
            {{ $films->links() }}
        </div>
    @endif
</main>
