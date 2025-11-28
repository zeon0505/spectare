<div>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('storage/' . $studio->image) }}" alt="{{ $studio->name }}" class="w-full h-64 object-cover">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $studio->name }}</h1>
                <p class="text-gray-600 dark:text-gray-400 text-lg mb-4">{{ $studio->location }}</p>

                <div class="mt-6">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Showtimes</h2>
                    @if($studio->showtimes->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($studio->showtimes as $showtime)
                                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $showtime->film->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $showtime->date->format('l, d F Y') }}</p>
                                    <div class="mt-2">
                                        <a href="{{ route('user.bookings.seat-selection', ['showtime' => $showtime->id]) }}" class="inline-block bg-amber-500 text-white rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2 hover:bg-amber-600">
                                            {{ $showtime->time->format('H:i') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 dark:text-gray-400">No showtimes available for this studio at the moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
