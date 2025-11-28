<main class="flex-1 overflow-auto">
    <!-- HEADER -->
    <div class="bg-gray-900 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-4xl font-extrabold tracking-tight mb-2">Showtimes</h1>
            <p class="text-lg text-gray-400">Find out what's showing and when.</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- FILTERS -->
        <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <div class="flex-1">
                <label for="date-filter" class="block mb-2 text-sm font-medium text-gray-300">Select Date</label>
                <input wire:model.live="selectedDate" type="date" id="date-filter" class="bg-gray-800 border border-gray-700 text-white text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5">
            </div>
            <div class="flex-1">
                <label for="film-filter" class="block mb-2 text-sm font-medium text-gray-300">Filter by Film</label>
                <select wire:model.live="selectedFilm" id="film-filter" class="bg-gray-800 border border-gray-700 text-white text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5">
                    <option value="all">All Films</option>
                    @foreach($filmOptions as $film)
                        <option value="{{ $film->id }}">{{ $film->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- SHOWTIME CARDS -->
        <div class="space-y-6">
            @forelse($filmsWithShowtimes as $film)
                <div class="showtime-card card-cinema card-hover p-6 rounded-lg">
                    <div class="flex flex-col sm:flex-row items-start justify-between mb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">{{ $film->title }}</h3>
                            @if($film->genres->isNotEmpty())
                                <p class="text-gray-400">{{ $film->genres->pluck('name')->implode(' • ') }} • {{ $film->duration_minutes }}m • Rating: {{ $film->censor_rating }}</p>
                            @endif
                        </div>
                        <div class="text-right mt-4 sm:mt-0">
                            @if($film->showtimes->isNotEmpty())
                                <p class="text-gray-400 text-sm">Studio {{ $film->showtimes->first()->studio->name }}</p>
                                <p class="text-amber-400 font-bold text-lg">Rp {{ number_format($film->ticket_price, 0, ',', '.') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-8 gap-2">
                        @foreach($film->showtimes as $showtime)
                            <a href="{{ route('user.bookings.seat-selection', ['showtime' => $showtime->id]) }}"
                               class="showtime-slot text-center bg-gray-700 hover:bg-amber-500 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                                {{ \Carbon\Carbon::parse($showtime->time)->format('H:i') }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-400 text-lg">No showtimes available for the selected date and film.</p>
                </div>
            @endforelse
        </div>
    </div>
</main>
