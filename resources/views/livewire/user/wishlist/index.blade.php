<div class="min-h-screen bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">

        <div class="mb-12 flex flex-col md:flex-row justify-between items-end gap-4">
            <div>
                <h1 class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 mb-3">My Wishlist</h1>
                <p class="text-gray-400 text-lg">Your personal collection of movies you want to watch.</p>
            </div>
            <div class="bg-slate-900/50 px-6 py-3 rounded-2xl border border-slate-800 backdrop-blur-sm">
                <span class="text-gray-400">Total Items:</span>
                <span class="text-2xl font-bold text-amber-500 ml-2">{{ $wishlists->count() }}</span>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 px-5 py-4 rounded-xl relative mb-8 shadow-lg backdrop-blur-sm flex items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="block sm:inline font-medium">{{ session('message') }}</span>
            </div>
        @endif

        @if($wishlists->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($wishlists as $item)
                    <div class="group relative bg-slate-900 rounded-3xl overflow-hidden shadow-2xl shadow-black/50 border border-slate-800 hover:border-amber-500/50 transition-all duration-500 hover:-translate-y-2">
                        <!-- Poster Section -->
                        <div class="relative aspect-[2/3] overflow-hidden">
                            <img src="{{ Str::startsWith($item->film->poster_url, 'http') ? $item->film->poster_url : Storage::url($item->film->poster_url) }}" 
                                 alt="{{ $item->film->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-300"></div>
                            
                            <!-- Rating Badge -->
                            <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-md px-3 py-1.5 rounded-xl flex items-center space-x-1 border border-white/10">
                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="text-sm font-bold text-white">{{ $item->film->average_rating ? number_format($item->film->average_rating, 1) : 'N/A' }}</span>
                            </div>

                            <!-- Remove Button (Absolute Top Left) -->
                            <button wire:click="removeFromWishlist({{ $item->id }})"
                                    class="absolute top-4 left-4 p-2.5 bg-red-500/20 hover:bg-red-500 text-red-500 hover:text-white rounded-xl backdrop-blur-md border border-red-500/30 transition-all duration-300 group/remove"
                                    title="Remove from Wishlist">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover/remove:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>

                        <!-- Content Section -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-slate-900 via-slate-900 to-transparent pt-12">
                            <h3 class="font-bold text-2xl text-white mb-2 line-clamp-1 group-hover:text-amber-400 transition-colors">
                                <a href="{{ route('user.films.show', $item->film) }}">{{ $item->film->title }}</a>
                            </h3>
                            
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($item->film->genres->take(2) as $genre)
                                        <span class="text-xs font-medium text-gray-400 bg-slate-800/80 px-2 py-1 rounded-lg border border-slate-700">
                                            {{ $genre->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <span class="text-sm font-semibold text-amber-500">
                                    {{ $item->film->duration }}m
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <a href="{{ route('user.films.show', $item->film) }}" 
                                   class="col-span-2 flex items-center justify-center py-3.5 bg-amber-500 hover:bg-amber-400 text-slate-900 rounded-xl font-bold transition-all shadow-lg shadow-amber-500/20 hover:shadow-amber-500/40 hover:scale-[1.02]">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                    </svg>
                                    Book Ticket
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24 px-6 border border-slate-800 rounded-3xl bg-slate-900/30 backdrop-blur-sm">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-slate-800 mb-6 shadow-xl shadow-black/20 ring-4 ring-slate-800/50">
                    <svg class="h-10 w-10 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-white mb-3">Your wishlist is empty</h3>
                <p class="text-gray-400 max-w-md mx-auto mb-10 text-lg">Start exploring movies and save your favorites here to watch later.</p>

                <a href="{{ route('user.films.index') }}" class="inline-flex items-center px-8 py-4 bg-amber-500 hover:bg-amber-400 text-slate-900 font-bold rounded-2xl shadow-xl shadow-amber-500/20 hover:shadow-amber-500/40 transition-all hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                    </svg>
                    Browse Movies
                </a>
            </div>
        @endif
    </div>
</div>
