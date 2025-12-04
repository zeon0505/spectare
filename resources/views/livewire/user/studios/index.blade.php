<div class="min-h-screen bg-slate-950">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <h1 class="text-4xl font-bold text-white">Cinema Studios</h1>
            <div class="w-full md:w-auto">
                <input wire:model.live.debounce.300ms="search" 
                       type="text" 
                       placeholder="Search studios..." 
                       class="w-full md:w-80 px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-amber-500 transition-colors">
            </div>
        </div>

        @if($studios->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($studios as $studio)
                    <a href="{{ route('user.studios.show', $studio) }}" 
                       class="group block bg-slate-900 rounded-2xl shadow-xl shadow-black/30 overflow-hidden border border-slate-800 hover:border-amber-500/50 transition-all duration-300 hover:transform hover:-translate-y-1">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $studio->image ? asset('storage/' . $studio->image) : 'https://via.placeholder.com/400x225.png/0f172a/fbbf24?text=No+Image' }}" 
                                 alt="{{ $studio->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-60"></div>
                        </div>
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-white mb-3 group-hover:text-amber-400 transition-colors">{{ $studio->name }}</h2>
                            <div class="flex items-center text-gray-400 mb-4">
                                <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>Capacity: <span class="text-white font-semibold">{{ $studio->capacity }}</span></span>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t border-slate-700">
                                <span class="text-sm text-gray-400 flex items-center">
                                    <svg class="w-4 h-4 text-amber-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $studio->showtimes_count }} Showtimes
                                </span>
                                <span class="text-amber-500 font-semibold flex items-center group-hover:text-amber-400 transition-colors">
                                    View Details
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $studios->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-slate-800 rounded-full mb-6">
                    <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-xl text-gray-400">No studios found matching your criteria.</p>
            </div>
        @endif
    </div>
</div>
