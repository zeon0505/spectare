<div class="min-h-screen bg-slate-950">
    <main class="flex-1">
        <!-- HEADER -->
        <div class="bg-slate-900 border-b border-slate-800">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <h1 class="text-5xl font-extrabold tracking-tight mb-3 text-white">Showtimes</h1>
                <p class="text-xl text-gray-400">Find out what's showing and when.</p>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- FILTERS -->
            <div class="bg-slate-900 rounded-2xl shadow-xl shadow-black/30 border border-slate-800 p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="date-filter" class="block mb-2 text-sm font-medium text-gray-300 flex items-center">
                            <svg class="w-4 h-4 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Select Date
                        </label>
                        <input wire:model.live="selectedDate" 
                               type="date" 
                               id="date-filter" 
                               class="bg-slate-800 border border-slate-700 text-white text-sm rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 block w-full p-3 transition-all">
                    </div>
                    <div>
                        <label for="film-filter" class="block mb-2 text-sm font-medium text-gray-300 flex items-center">
                            <svg class="w-4 h-4 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                            </svg>
                            Filter by Film
                        </label>
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" 
                                    @click.away="open = false"
                                    type="button"
                                    class="flex items-center justify-between w-full bg-slate-800 border border-slate-700 text-white text-sm rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 p-3 transition-all">
                                <span class="truncate">
                                    {{ $selectedFilm === 'all' ? 'All Films' : ($filmOptions->firstWhere('id', $selectedFilm)?->title ?? 'All Films') }}
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
                                    <button wire:click="$set('selectedFilm', 'all')" 
                                            @click="open = false"
                                            class="w-full text-left px-4 py-2.5 text-sm hover:bg-slate-700 transition-colors {{ $selectedFilm === 'all' ? 'text-amber-500 font-bold bg-slate-700/50' : 'text-gray-300' }}">
                                        All Films
                                    </button>
                                    @foreach($filmOptions as $film)
                                        <button wire:click="$set('selectedFilm', '{{ $film->id }}')"
                                                @click="open = false"
                                                class="w-full text-left px-4 py-2.5 text-sm hover:bg-slate-700 transition-colors {{ $selectedFilm == $film->id ? 'text-amber-500 font-bold bg-slate-700/50' : 'text-gray-300' }}">
                                            {{ $film->title }}
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

            <!-- SHOWTIME CARDS -->
            <div class="space-y-6">
                @forelse($filmsWithShowtimes as $film)
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl shadow-black/30 p-6 hover:border-amber-500/30 transition-all duration-300">
                        <div class="flex flex-col sm:flex-row items-start justify-between mb-6 gap-4">
                            <div class="flex-1">
                                <h3 class="text-3xl font-bold text-white mb-2">{{ $film->title }}</h3>
                                @if($film->genres->isNotEmpty())
                                    <div class="flex flex-wrap gap-2 mb-2">
                                        @foreach($film->genres->take(3) as $genre)
                                            <span class="inline-block bg-slate-800 border border-slate-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-400">
                                                {{ $genre->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <p class="text-gray-400 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $film->duration_minutes }}m
                                        <span class="mx-1">•</span>
                                        Rating: {{ $film->censor_rating }}
                                    </p>
                                @endif
                            </div>
                            <div class="text-left sm:text-right">
                                @if($film->showtimes->isNotEmpty())
                                    <p class="text-gray-400 text-sm mb-1 flex items-center sm:justify-end gap-1">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        Studio {{ $film->showtimes->first()->studio->name }}
                                    </p>
                                    <p class="text-amber-400 font-bold text-2xl">Rp {{ number_format($film->ticket_price, 0, ',', '.') }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="border-t border-slate-700 pt-4">
                            <p class="text-sm text-gray-400 mb-3 flex items-center">
                                <svg class="w-4 h-4 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Available Times
                            </p>
                            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-3">
                                @foreach($film->showtimes as $showtime)
                                    <a href="{{ route('user.bookings.seat-selection', ['showtime' => $showtime->id]) }}"
                                       class="text-center bg-slate-800 hover:bg-amber-500 hover:text-slate-900 text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-amber-500/20 border border-slate-700 hover:border-amber-500">
                                        {{ \Carbon\Carbon::parse($showtime->time)->format('H:i') }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-slate-900 rounded-2xl border border-slate-800">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-800 rounded-full mb-4">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-xl">No showtimes available for the selected date and film.</p>
                        <p class="text-gray-500 text-sm mt-2">Try selecting a different date or film.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</div>
