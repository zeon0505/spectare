<div class="min-h-screen bg-slate-950">
    <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8" wire:poll.10s>

        <!-- Header -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">Films Collection</h1>
                <p class="text-gray-400">Discover our latest movies and coming soon titles</p>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-slate-900 rounded-2xl shadow-xl shadow-black/30 p-6 mb-8 border border-slate-800">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2" for="search">
                        <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search Films
                    </label>
                    <div class="relative">
                        <input wire:model.live.debounce.300ms="search" 
                               type="text" 
                               placeholder="Enter film title..."
                               id="search"
                               class="shadow-sm appearance-none border border-slate-700 bg-slate-800 rounded-xl w-full py-3 px-4 text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder:text-gray-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2" for="genre">
                        <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Filter by Genre
                    </label>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" 
                                @click.away="open = false"
                                type="button"
                                class="flex items-center justify-between w-full shadow-sm border border-slate-700 bg-slate-800 rounded-xl py-3 px-4 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                            <span class="truncate">
                                {{ $genres->firstWhere('id', $selectedGenre)?->name ?? 'All Genres' }}
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute z-20 mt-2 w-full bg-slate-800 border border-slate-700 rounded-xl shadow-xl max-h-60 overflow-y-auto scroll-smooth custom-scrollbar"
                             style="display: none;">
                            
                            <div class="py-1">
                                <button wire:click="$set('selectedGenre', '')" 
                                        @click="open = false"
                                        class="w-full text-left px-4 py-2.5 text-sm hover:bg-slate-700 transition-colors {{ $selectedGenre === '' ? 'text-amber-500 font-bold bg-slate-700/50' : 'text-gray-300' }}">
                                    All Genres
                                </button>
                                @foreach ($genres as $genre)
                                    <button wire:click="$set('selectedGenre', '{{ $genre->id }}')"
                                            @click="open = false"
                                            class="w-full text-left px-4 py-2.5 text-sm hover:bg-slate-700 transition-colors {{ $selectedGenre == $genre->id ? 'text-amber-500 font-bold bg-slate-700/50' : 'text-gray-300' }}">
                                        {{ $genre->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <style>
                        .custom-scrollbar::-webkit-scrollbar {
                            width: 8px;
                        }
                        .custom-scrollbar::-webkit-scrollbar-track {
                            background: #1e293b; /* slate-800 */
                            border-radius: 0 8px 8px 0;
                        }
                        .custom-scrollbar::-webkit-scrollbar-thumb {
                            background: #475569; /* slate-600 */
                            border-radius: 4px;
                        }
                        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                            background: #64748b; /* slate-500 */
                        }
                    </style>
                </div>
            </div>
        </div>

        <!-- Films Grid -->
        @if($films->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach ($films as $film)
                    <a href="{{ route('user.films.show', $film) }}" 
                       class="group block" 
                       wire:key="{{ $film->id }}">
                        <div class="bg-slate-900 rounded-2xl overflow-hidden shadow-xl shadow-black/30 border border-slate-800 hover:border-amber-500/50 transition-all duration-300 hover:transform hover:-translate-y-2">
                            <!-- Poster -->
                            <div class="relative aspect-[2/3] overflow-hidden">
                                <img src="{{ asset('storage/' . $film->poster_url) }}" 
                                     alt="{{ $film->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <!-- Rating Badge -->
                                <div class="absolute top-2 right-2 bg-black/70 backdrop-blur-md px-2 py-1 rounded-lg flex items-center space-x-1">
                                    <svg class="w-3 h-3 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="text-xs font-bold text-white">
                                        {{ $film->average_rating ? number_format($film->average_rating, 1) : 'N/A' }}
                                    </span>
                                </div>
                                
                                <!-- Status Badge -->
                                @if($film->status)
                                    <div class="absolute top-2 left-2">
                                        <span class="px-2 py-1 text-xs font-bold rounded-full {{ $film->status == 'Now Showing' ? 'bg-green-500/90 text-white' : 'bg-amber-500/90 text-slate-900' }}">
                                            {{ $film->status }}
                                        </span>
                                    </div>
                                @endif

                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/40 backdrop-blur-sm">
                                    <div class="w-12 h-12 rounded-full bg-amber-500 flex items-center justify-center transform scale-0 group-hover:scale-100 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-slate-900" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Film Info -->
                            <div class="p-4">
                                <h3 class="font-bold text-white text-sm mb-2 line-clamp-2 group-hover:text-amber-400 transition-colors">
                                    {{ $film->title }}
                                </h3>
                                
                                <!-- Genres -->
                                <div class="flex flex-wrap gap-1 mb-2">
                                    @foreach ($film->genres->take(2) as $genre)
                                        <span class="inline-block bg-slate-800 border border-slate-700 rounded-full px-2 py-0.5 text-xs font-semibold text-gray-400">
                                            {{ $genre->name }}
                                        </span>
                                    @endforeach
                                </div>

                                <!-- Release Date & Duration -->
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $film->release_date->format('d M Y') }}
                                    </span>
                                    @if($film->duration)
                                        <span class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $film->duration }}m
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20 bg-slate-900 rounded-2xl border border-slate-800">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-800 rounded-full mb-4">
                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <p class="text-xl font-medium text-gray-300 mb-2">No films found</p>
                <p class="text-sm text-gray-500">
                    @if ($search || $selectedGenre)
                        Try adjusting your search or filter criteria.
                    @else
                        There are currently no films to display.
                    @endif
                </p>
            </div>
        @endif

        <!-- Pagination -->
        @if ($films->hasPages())
            <div class="mt-8">
                {{ $films->links() }}
            </div>
        @endif
    </main>
</div>
