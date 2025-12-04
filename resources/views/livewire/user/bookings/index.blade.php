<div class="min-h-screen bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">

        <div class="mb-12">
            <h1 class="text-5xl font-black text-white mb-3">My Bookings</h1>
            <p class="text-gray-400 text-lg">History of your movie tickets and transactions.</p>
        </div>

        <div class="space-y-4">
            @forelse ($bookings as $booking)
                <div class="bg-slate-900 shadow-2xl shadow-black/30 rounded-2xl overflow-hidden border border-slate-800 hover:border-amber-500/30 transition-all duration-300">
                    <div class="p-6 hover:bg-slate-800/30 transition-colors duration-200">
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">

                            <!-- Film Info -->
                            <div class="flex-1 flex items-start gap-4">
                                <!-- Poster Thumbnail -->
                                <div class="flex-shrink-0 w-20 h-28 rounded-lg overflow-hidden shadow-lg">
                                    <img src="{{ Str::startsWith($booking->showtime->film->poster_url, 'http') ? $booking->showtime->film->poster_url : Storage::url($booking->showtime->film->poster_url) }}" 
                                         alt="{{ $booking->showtime->film->title }}"
                                         class="w-full h-full object-cover">
                                </div>

                                <div class="flex-1">
                                    <h2 class="text-2xl font-bold text-white mb-2">
                                        {{ $booking->showtime->film->title }}
                                    </h2>

                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-400 mb-3">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $booking->showtime->start_time->format('D, d M Y') }}
                                        </span>
                                        <span class="text-slate-600">|</span>
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $booking->showtime->start_time->format('H:i') }}
                                        </span>
                                        <span class="text-slate-600">|</span>
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            {{ $booking->showtime->studio->name }}
                                        </span>
                                    </div>

                                    <p class="text-amber-400 font-bold text-2xl">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Status & Actions -->
                            <div class="flex flex-col items-start lg:items-end gap-4 w-full lg:w-auto">
                                <span class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-full border
                                    {{ $booking->status == 'paid' || $booking->status == 'confirmed'
                                        ? 'bg-green-500/20 text-green-400 border-green-500/30'
                                        : 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>

                                <a href="{{ route('user.bookings.detail', $booking) }}"
                                   class="inline-flex items-center bg-amber-500 hover:bg-amber-400 text-slate-900 font-bold py-3 px-6 rounded-xl text-sm transition-all shadow-lg shadow-amber-500/20 hover:scale-105 transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                    View E-Ticket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-slate-900 rounded-2xl border border-slate-800 py-20 px-6 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-slate-800 mb-6">
                            <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3">No bookings yet</h3>
                        <p class="text-gray-400 text-lg mb-8">You haven't booked any movies yet.</p>
                        <a href="{{ route('user.films.index') }}" 
                           class="inline-flex items-center px-8 py-4 border border-transparent text-sm font-bold rounded-2xl shadow-2xl text-slate-900 bg-amber-500 hover:bg-amber-400 transition-all hover:scale-105 shadow-amber-500/30">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                            </svg>
                            Browse Movies
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
