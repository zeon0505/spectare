<div class="min-h-screen bg-slate-950">
    <div class="container mx-auto px-4 py-8">
        <!-- Studio Header with Image -->
        <div class="bg-slate-900 rounded-2xl shadow-2xl shadow-black/50 overflow-hidden border border-slate-800 mb-8">
            <div class="relative h-64 md:h-80 overflow-hidden">
                <img src="{{ asset('storage/' . $studio->image) }}" 
                     alt="{{ $studio->name }}" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 w-full">
                    <h1 class="text-5xl font-bold text-white mb-2 drop-shadow-lg">{{ $studio->name }}</h1>
                    @if($studio->location)
                        <p class="text-gray-300 text-lg flex items-center">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $studio->location }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Showtimes Section -->
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-white mb-6 flex items-center">
                <svg class="w-8 h-8 text-amber-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Showtimes
            </h2>
            
            @if($studio->showtimes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($studio->showtimes as $showtime)
                        <div class="bg-slate-900 rounded-xl p-6 border border-slate-800 hover:border-amber-500/50 transition-all duration-300 hover:transform hover:-translate-y-1 shadow-lg shadow-black/30">
                            <h3 class="text-xl font-bold text-white mb-2">{{ $showtime->film->title }}</h3>
                            <div class="flex items-center text-gray-400 text-sm mb-4">
                                <svg class="w-4 h-4 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $showtime->date->format('l, d F Y') }}
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('user.bookings.seat-selection', ['showtime' => $showtime->id]) }}" 
                                   class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-slate-900 rounded-full px-4 py-2 text-sm font-bold transition-all transform hover:scale-105 shadow-lg shadow-amber-500/20">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $showtime->time->format('H:i') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-slate-900 rounded-2xl border border-slate-800">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-800 rounded-full mb-4">
                        <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-xl text-gray-400">No showtimes available for this studio at the moment.</p>
                </div>
            @endif
        </div>

        <!-- Back Button -->
        <div class="mt-8 flex justify-center">
            <a href="{{ route('user.studios.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-white font-semibold rounded-xl transition-all">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Studios
            </a>
        </div>
    </div>
</div>
