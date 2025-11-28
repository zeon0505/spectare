<div>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Cinema Studios</h1>
            <div class="flex space-x-4">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search studios..." class="px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
        </div>

        @if($studios->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($studios as $studio)
                    <a href="{{ route('user.studios.show', $studio) }}" class="block bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ $studio->image ? asset('storage/' . $studio->image) : 'https://via.placeholder.com/400x225.png/0f172a/fbbf24?text=No+Image' }}" alt="{{ $studio->name }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $studio->name }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">Capacity: {{ $studio->capacity }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-500 dark:text-gray-300">{{ $studio->showtimes_count }} Showtimes Available</span>
                                <span class="text-amber-500 font-semibold">View Details &rarr;</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $studios->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-xl text-gray-600 dark:text-gray-400">No studios found matching your criteria.</p>
            </div>
        @endif
    </div>
</div>
