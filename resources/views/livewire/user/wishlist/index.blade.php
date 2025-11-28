<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-2 drop-shadow-md">My Wishlist</h1>
        <p class="text-gray-400 text-sm">Your personal collection of movies you want to watch.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 px-5 py-4 rounded-lg relative mb-8 shadow-md flex items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="block sm:inline font-medium">{{ session('message') }}</span>
        </div>
    @endif

    @if($wishlists->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($wishlists as $item)
                <div class="bg-slate overflow-hidden shadow-lg rounded-lg">
                    <a href="{{ route('films.show', $item->film) }}">
                        <img src="{{ Str::startsWith($item->film->poster_url, 'http') ? $item->film->poster_url : Storage::url($item->film->poster_url) }}" alt="{{ $item->film->title }}" class="w-full h-64 object-cover">
                    </a>
                    <div class="p-4">
                        <div class="mb-4 flex-grow">
                            <h3 class="font-bold text-lg text-white mb-1 line-clamp-1 hover:text-amber-500 transition-colors">
                                <a href="{{ route('films.show', $item->film) }}">{{ $item->film->title }}</a>
                            </h3>
                            <p class="text-gray-400 text-sm">
                                {{ $item->film->genres->pluck('name')->join(', ') }}
                            </p>
                            <p class="text-amber-500 text-sm font-medium">
                                {{ $item->film->release_date->format('Y') }}
                            </p>
                        </div>

                        <button wire:click="removeFromWishlist({{ $item->id }})"
                                class="w-full flex items-center justify-center py-2.5 px-4 bg-red-500/10 text-red-500 border border-red-500/50 rounded-lg hover:bg-red-500 hover:text-white transition-all duration-200 font-semibold text-sm group/btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transition-transform group-hover/btn:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Remove
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 px-6 border-2 border-dashed border-slate-700 rounded-xl bg-slate-800/50">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-800 mb-6 shadow-inner">
                <svg class="h-10 w-10 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Your wishlist is empty</h3>
            <p class="text-gray-400 max-w-sm mx-auto mb-8">Start exploring movies and save your favorites here to watch later.</p>

            <a href="{{ route('user.films.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-lg shadow-lg text-slate-900 bg-amber-500 hover:bg-amber-600 transition-all hover:scale-105">
                Browse Movies
            </a>
        </div>
    @endif
</div>
