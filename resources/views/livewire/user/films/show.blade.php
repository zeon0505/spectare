<div class="min-h-screen bg-slate-950">
    <main class="flex-1 p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">

            @if (session()->has('error'))
                <div class="bg-red-500/10 border-l-4 border-red-500 text-red-400 px-5 py-4 rounded-lg relative mb-8 shadow-md flex items-center backdrop-blur-sm" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    <span class="block sm:inline font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Movie Poster and Trailer -->
                <div class="lg:col-span-1">
                    <div class="sticky top-8" x-data="{ isPlaying: false }">
                        @php
                            $trailerId = '';
                            if ($film->trailer_url) {
                                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $film->trailer_url, $matches);
                                $trailerId = $matches[1] ?? '';
                            }
                        @endphp

                        <div class="relative w-full rounded-2xl overflow-hidden shadow-2xl shadow-black/50 border border-slate-800 bg-black aspect-[2/3]">
                            
                            <!-- Poster Image & Overlay -->
                            <div x-show="!isPlaying" class="absolute inset-0 w-full h-full group cursor-pointer" 
                                 @if($trailerId) @click="isPlaying = true" @endif>
                                <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" 
                                     alt="{{ $film->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-300"></div>
                                
                                @if($trailerId)
                                    <!-- Play Button Overlay -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                        <div class="w-20 h-14 bg-red-600 rounded-xl flex items-center justify-center shadow-2xl transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                            <svg class="w-8 h-8 text-white fill-current" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- YouTube Iframe -->
                            @if($trailerId)
                                <template x-if="isPlaying">
                                    <div class="absolute inset-0 w-full h-full bg-black">
                                        <iframe 
                                            src="https://www.youtube.com/embed/{{ $trailerId }}?autoplay=1&rel=0&showinfo=0&modestbranding=1" 
                                            class="w-full h-full"
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                        </iframe>
                                        
                                        <!-- Close Button -->
                                        <button @click="isPlaying = false" class="absolute top-4 right-4 z-10 p-2 bg-black/50 text-white/70 hover:text-white hover:bg-black/80 rounded-full transition-all backdrop-blur-sm">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            @endif
                        </div>

                        @if ($film->trailer_url)
                            <button x-show="!isPlaying" 
                                    @if($trailerId) @click="isPlaying = true" @else onclick="window.open('{{ $film->trailer_url }}', '_blank')" @endif
                                    class="mt-4 flex items-center justify-center w-full px-6 py-4 bg-amber-500 hover:bg-amber-400 border border-transparent rounded-xl font-bold text-slate-900 uppercase tracking-wider transition-all transform hover:scale-105 shadow-lg shadow-amber-500/20">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"></path>
                                </svg>
                                Watch Trailer
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Movie Details and Showtimes -->
                <div class="lg:col-span-2">
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl shadow-black/50 p-8">
                        <h1 class="text-5xl font-bold text-amber-400 mb-3">{{ $film->title }}</h1>
                        <div class="flex items-center space-x-4 text-gray-400 text-lg mb-6">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-1 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($film->release_date)->format('Y') }}
                            </span>
                            <span>&bull;</span>
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-1 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $film->duration }} min
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach ($film->genres as $genre)
                                <span class="inline-block bg-slate-800 border border-slate-700 rounded-full px-4 py-1.5 text-sm font-semibold text-gray-300">{{ $genre->name }}</span>
                            @endforeach
                        </div>

                        <p class="text-gray-300 leading-relaxed text-lg mb-8">{{ $film->description }}</p>

                        <div class="mb-8">
                            <button wire:click="toggleWishlist"
                                class="inline-flex items-center px-6 py-3 rounded-xl font-bold text-sm transition-all transform hover:scale-105 shadow-lg
                                    @if ($isInWishlist)
                                        bg-red-600 hover:bg-red-700 text-white shadow-red-500/20
                                    @else
                                        bg-amber-500 hover:bg-amber-600 text-slate-900 shadow-amber-500/20
                                    @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                                @if ($isInWishlist)
                                    Remove from Wishlist
                                @else
                                    Add to Wishlist
                                @endif
                            </button>
                        </div>

                        <div>
                            <h2 class="text-3xl font-bold text-amber-400 mb-6 flex items-center">
                                <svg class="w-7 h-7 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                Showtimes
                            </h2>
                            
                            @forelse ($upcomingShowtimes->groupBy(fn($showtime) => $showtime->date->format('Y-m-d')) as $date => $showtimes)
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold text-gray-300 mb-4 flex items-center">
                                        <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
                                    </h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach ($showtimes as $showtime)
                                            <div class="bg-slate-800/80 border border-slate-700/50 rounded-xl p-5 hover:border-amber-500/50 transition-all duration-300 shadow-lg hover:transform hover:-translate-y-1">
                                                <div class="flex justify-between items-start mb-4">
                                                    <div>
                                                        <p class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold mb-1.5">Studio</p>
                                                        <p class="text-white font-bold text-lg">{{ $showtime->studio->name }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold mb-1.5">Time</p>
                                                        <p class="text-amber-500 font-bold text-2xl tracking-tight">{{ \Carbon\Carbon::parse($showtime->time)->format('H:i') }}</p>
                                                    </div>
                                                </div>
                                                <button wire:click="selectShowtime('{{ $showtime->id }}')"
                                                    class="w-full bg-slate-700/80 hover:bg-amber-500 hover:text-slate-900 text-gray-300 font-semibold py-3 px-4 rounded-lg transition-all duration-200 hover:shadow-lg hover:shadow-amber-500/20">
                                                    Book Ticket
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 bg-slate-800/50 rounded-xl border border-slate-700">
                                    <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-gray-400 text-lg">No showtimes available for this film yet.</p>
                                </div>
                            @endforelse
                        </div>

                        @if ($selectedShowtime)
                            <div class="mt-8 bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
                                <h2 class="text-2xl font-bold text-amber-400 mb-4 flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Select Seats
                                </h2>
                                <div class="space-y-4">
                                    {{-- Seat Layout --}}
                                    <div class="p-6 border-2 border-slate-700 border-dashed rounded-xl bg-slate-900/50">
                                        <div class="w-full h-10 mb-6 bg-gray-800 rounded-lg text-center text-white flex items-center justify-center shadow-lg">
                                            <span class="text-sm font-bold tracking-widest">SCREEN</span>
                                        </div>
                                        @if (!empty($seats))
                                            <div class="space-y-2">
                                                @foreach ($seats as $row)
                                                    <div class="flex justify-center space-x-2">
                                                        @foreach ($row as $seat)
                                                            @if ($seat['status'] === 'space')
                                                                <div class="w-8 h-8"></div>
                                                            @else
                                                                <button wire:click="toggleSeat('{{ $seat['number'] }}')"
                                                                    @class([
                                                                        'w-8 h-8 rounded-md flex items-center justify-center font-semibold text-sm transition-all duration-200',
                                                                        'bg-amber-500 text-slate-900 shadow-lg shadow-amber-500/30' => $seat['status'] === 'available' && in_array($seat['number'], $selectedSeats),
                                                                        'bg-green-600 text-white hover:bg-amber-500 hover:text-slate-900' => $seat['status'] === 'available' && !in_array($seat['number'], $selectedSeats),
                                                                        'bg-red-600 text-white cursor-not-allowed opacity-50' => $seat['status'] === 'booked',
                                                                    ])
                                                                    @if ($seat['status'] === 'booked') disabled @endif>
                                                                </button>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center py-8">
                                                <p class="text-gray-400">Maaf, tata letak kursi untuk pertunjukan ini tidak tersedia.</p>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Legend & Summary --}}
                                    <div class="bg-slate-800/50 rounded-xl p-4 border border-slate-700">
                                        <div class="flex justify-between items-center mb-4">
                                            <div class="flex items-center space-x-4 text-sm text-gray-300">
                                                <div class="flex items-center"><span class="w-4 h-4 rounded-sm bg-green-600 mr-2"></span> Available</div>
                                                <div class="flex items-center"><span class="w-4 h-4 rounded-sm bg-amber-500 mr-2"></span> Selected</div>
                                                <div class="flex items-center"><span class="w-4 h-4 rounded-sm bg-red-600 mr-2"></span> Booked</div>
                                            </div>
                                            <p class="text-gray-300">Selected: <span class="font-bold text-white">{{ count($selectedSeats) }}</span></p>
                                        </div>
                                        <div class="flex items-center justify-between pt-4 border-t border-slate-700">
                                            <p class="text-lg text-gray-300">Total Price: <span class="font-bold text-amber-400 text-2xl">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span></p>
                                            <button wire:click="proceedToBooking" @if(count($selectedSeats) === 0) disabled @endif
                                                class="px-8 py-3 bg-amber-500 hover:bg-amber-400 border border-transparent rounded-xl font-bold text-slate-900 uppercase tracking-wider transition-all transform hover:scale-105 shadow-lg shadow-amber-500/20 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                                Book Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-12">
                <h2 class="text-3xl font-bold text-amber-400 mb-8 flex items-center">
                    <svg class="w-7 h-7 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    Reviews
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl shadow-black/30">
                        <h3 class="text-xl font-bold text-white mb-4">Leave a Review</h3>
                        @auth
                            @if(Auth::user()->hasBookedFilm($film->id))
                                @if(Auth::user()->hasNotReviewed($film->id))
                                    <livewire:user.reviews.create :film="$film" />
                                @else
                                    <p class="text-gray-400">You have already reviewed this film.</p>
                                @endif
                            @else
                                <p class="text-gray-400">You must book a ticket for this film to leave a review.</p>
                            @endauth
                        @else
                            <p class="text-gray-400">Please <a href="{{ route('login') }}" class="text-amber-500 hover:underline">login</a> to leave a review.</p>
                        @endauth
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-4">User Reviews</h3>
                        <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                            @forelse ($reviews as $review)
                                <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 shadow-lg">
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="font-semibold text-white">{{ $review->user->name }}</p>
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $review->rating >= $i ? 'text-amber-500' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.365 2.444a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.365-2.444a1 1 0 00-1.175 0l-3.365 2.444c-.784.57-1.838-.197-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.073 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-gray-300 leading-relaxed mb-2">{{ $review->comment }}</p>
                                    <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            @empty
                                <div class="text-center py-8 bg-slate-900 rounded-xl border border-slate-800">
                                    <p class="text-gray-400">No reviews for this film yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('open-midtrans-popup', (event) => {
                    if (event.token) {
                        window.snap.pay(event.token, {
                            onSuccess: function(result) {
                                window.location.href = "{{ route('user.bookings.index') }}";
                            },
                            onPending: function(result) {
                                window.location.href = "{{ route('user.bookings.index') }}";
                            },
                            onError: function(result) {
                                window.location.reload();
                            },
                            onClose: function() {
                                window.location.reload();
                            }
                        });
                    } else {
                        console.error('Snap token not received.');
                        alert('Gagal memuat halaman pembayaran. Silakan coba lagi.');
                    }
                });
            });
        </script>
        @endpush
    </main>
</div>