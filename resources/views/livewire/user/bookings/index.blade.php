<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-2 drop-shadow-md">My Bookings</h1>
        <p class="text-gray-400 text-sm">History of your movie tickets and transactions.</p>
    </div>

    <div class="bg-slate-800 shadow-2xl shadow-black/50 rounded-xl overflow-hidden border border-slate-700">
        <ul class="divide-y divide-slate-700">
            @forelse ($bookings as $booking)
                <li class="p-6 hover:bg-slate-700/30 transition-colors duration-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-white mb-1">
                                {{ $booking->showtime->film->title }}
                            </h2>

                            <div class="flex items-center text-sm text-gray-400 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $booking->showtime->start_time->format('D, d M Y') }}
                                <span class="mx-2 text-slate-600">|</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $booking->showtime->start_time->format('H:i') }}
                            </div>

                            <p class="text-amber-500 font-bold text-lg">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex items-center space-x-4 self-end sm:self-center">
                            <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full border
                                {{ $booking->status == 'paid' || $booking->status == 'confirmed'
                                    ? 'bg-green-500/10 text-green-400 border-green-500/20'
                                    : 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20' }}">
                                {{ ucfirst($booking->status) }}
                            </span>

                            <a href="{{ route('user.bookings.detail', $booking) }}"
                               class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2 px-4 rounded-lg text-sm transition-all shadow-lg shadow-amber-500/20 hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                View E-Ticket
                            </a>
                        </div>
                    </div>
                </li>
            @empty
                <li class="py-16 px-6 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-white">No bookings yet</h3>
                        <p class="text-gray-400 mt-1 text-sm">You haven't booked any movies yet.</p>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>

    <div class="mt-8">
        {{ $bookings->links() }}
    </div>
</div>
