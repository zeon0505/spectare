<div class="text-white">
    <div class="container mx-auto px-4 py-8">
        {{-- Now Showing Section --}}
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-amber-400 mb-6 border-l-4 border-amber-400 pl-4">Now Showing</h2>
            @if($nowShowingFilms->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($nowShowingFilms as $film)
                        <a href="{{ route('films.show', $film) }}" class="group">
                            <div class="relative overflow-hidden rounded-lg">
                                <img src="{{ Storage::url($film->poster) }}" alt="{{ $film->title }}" class="w-full h-auto transform transition-transform duration-300 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <p class="text-white text-lg font-bold">Book Now</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-lg font-semibold">{{ $film->title }}</h3>
                                <p class="text-sm text-gray-400">{{ $film->genres->pluck('name')->join(', ') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 bg-gray-800 rounded-lg">
                    <p class="text-gray-400">No films currently showing.</p>
                </div>
            @endif
        </div>

        {{-- Coming Soon Section --}}
        <div>
            <h2 class="text-2xl font-bold text-amber-400 mb-6 border-l-4 border-amber-400 pl-4">Coming Soon</h2>
            @if($comingSoonFilms->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($comingSoonFilms as $film)
                        <div class="group">
                            <div class="relative overflow-hidden rounded-lg">
                                <img src="{{ Storage::url($film->poster) }}" alt="{{ $film->title }}" class="w-full h-auto">
                            </div>
                            <div class="mt-4">
                                <h3 class="text-lg font-semibold">{{ $film->title }}</h3>
                                <p class="text-sm text-gray-400">{{ $film->genres->pluck('name')->join(', ') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 bg-gray-800 rounded-lg">
                    <p class="text-gray-400">No films coming soon.</p>
                </div>
            @endif
        </div>
    </div>
</div>
