<main class="flex-1 overflow-y-auto p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">

        @if (session()->has('error'))
            <div class="bg-red-500/10 border-l-4 border-red-500 text-red-400 px-5 py-4 rounded-lg relative mb-8 shadow-md flex items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Movie Poster and Trailer -->
            <div class="lg:col-span-1">
                <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" alt="{{ $film->title }}" class="rounded-lg shadow-lg w-full">
                @if ($film->trailer_url)
                    <a href="{{ $film->trailer_url }}" target="_blank"
                        class="mt-4 inline-block w-full text-center px-6 py-3 bg-amber-500 border border-transparent rounded-md font-semibold text-slate-900 uppercase tracking-widest hover:bg-amber-400 transition ease-in-out duration-150">
                        Watch Trailer
                    </a>
                @endif
            </div>

            <!-- Movie Details and Showtimes -->
            <div class="lg:col-span-2">
                <div class="bg-slate-800/50 border border-slate-700 rounded-lg shadow-lg p-6">
                    <h1 class="text-4xl font-bold text-amber-400">{{ $film->title }}</h1>
                    <div class="mt-2 flex items-center space-x-4 text-gray-400">
                        <span>{{ \Carbon\Carbon::parse($film->release_date)->format('Y') }}</span>
                        <span>&bull;</span>
                        <span>{{ $film->duration }} min</span>
                    </div>
                    <div class="mt-4">
                        @foreach ($film->genres as $genre)
                            <span class="inline-block bg-slate-700 rounded-full px-3 py-1 text-sm font-semibold text-gray-300 mr-2 mb-2">{{ $genre->name }}</span>
                        @endforeach
                    </div>

                    <p class="mt-6 text-gray-300 leading-relaxed">{{ $film->description }}</p>

                    <div class="mt-6">
                        <button wire:click="toggleWishlist"
                            class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-sm transition-colors duration-200
                                @if ($isInWishlist)
                                    bg-red-600 hover:bg-red-700 text-white
                                @else
                                    bg-amber-500 hover:bg-amber-600 text-slate-900
                                @endif
                            \">
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

                    <div class="mt-8">
                        <h2 class="text-2xl font-bold text-amber-400 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            Showtimes
                        </h2>
                        
                        @forelse ($upcomingShowtimes->groupBy(fn($showtime) => $showtime->date->format('Y-m-d')) as $date => $showtimes)
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-300 mb-4">
                                    {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($showtimes as $showtime)
                                        <div class="bg-slate-900/80 border border-slate-700/50 rounded-xl p-5 hover:border-amber-500/50 transition-all duration-300 shadow-lg">
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
                                                class="w-full bg-slate-800/80 hover:bg-amber-500 hover:text-slate-900 text-gray-300 font-semibold py-3 px-4 rounded-lg transition-all duration-200 hover:shadow-lg hover:shadow-amber-500/20">
                                                Book Ticket
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400">No showtimes available for this film yet.</p>
                        @endforelse
                    </div>

                    @if ($selectedShowtime)
                        <div class="mt-8">
                            <h2 class="text-2xl font-bold text-amber-400 mb-4">Select Seats</h2>
                            <div class="bg-slate-900/50 border border-slate-700 rounded-lg p-4">
                                <div class="flex justify-center mb-4">
                                    <div class="bg-slate-600 text-white text-center py-1 px-8 rounded-md">Screen</div>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-gray-400">Pilih kursi yang tersedia di bawah ini.</p>

                                    {{-- Seat Layout --}}
                                    <div class="mt-4 p-4 border-2 border-gray-700 border-dashed rounded-lg bg-slate-800/50">
                                        <div class="w-full h-8 mb-4 bg-gray-900 rounded-sm text-center text-white flex items-center justify-center">
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
                                                                        'w-8 h-8 rounded-md flex items-center justify-center font-semibold text-sm transition-colors duration-200',
                                                                        'bg-amber-500 text-slate-900' => $seat['status'] === 'available' && in_array($seat['number'], $selectedSeats),
                                                                        'bg-green-600 text-white hover:bg-amber-500 hover:text-slate-900' => $seat['status'] === 'available' && !in_array($seat['number'], $selectedSeats),
                                                                        'bg-red-600 text-white cursor-not-allowed' => $seat['status'] === 'booked',
                                                                    ])
                                                                    @if ($seat['status'] === 'booked') disabled @endif>
                                                                    {{-- {{ $seat['number'] }} --}}
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
                                    <div class="mt-6 pt-4 border-t border-slate-700">
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <div class="flex items-center"><span class="w-4 h-4 rounded-sm bg-green-600 mr-2"></span> Available</div>
                                                <div class="flex items-center"><span class="w-4 h-4 rounded-sm bg-amber-500 mr-2"></span> Selected</div>
                                                <div class="flex items-center"><span class="w-4 h-4 rounded-sm bg-red-600 mr-2"></span> Booked</div>>
                                            </div>
                                            <div>
                                                <p class="text-gray-300">Selected: <span class="font-bold text-white">{{ count($selectedSeats) }}</span></p>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-gray-300">Total Price: <span class="font-bold text-amber-400">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span></p>
                                        </div>
                                        <button wire:click="proceedToBooking" @if(count($selectedSeats) === 0) disabled @endif
                                            class="px-6 py-3 bg-amber-500 border border-transparent rounded-md font-semibold text-slate-900 uppercase tracking-widest hover:bg-amber-400 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed\">
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

        <div class="mt-8">
            <h2 class="text-2xl font-bold text-amber-400 mb-4">Reviews</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
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
                    <div class="space-y-4">
                        @forelse ($reviews as $review)
                            <div class="bg-slate-800/50 border border-slate-700 rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <p class="font-semibold text-white">{{ $review->user->name }}</p>
                                    <div class="ml-auto flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $review->rating >= $i ? 'text-yellow-400' : 'text-gray-500' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.365 2.444a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.365-2.444a1 1 0 00-1.175 0l-3.365 2.444c-.784.57-1.838-.197-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.073 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-300">{{ $review->comment }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            <p class="text-gray-400">No reviews for this film yet.</p>
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
                            /* You may add your own implementation here */
                            // alert("payment success!");
                            // console.log(result);
                            window.location.href = "{{ route('user.bookings.index') }}";
                        },
                        onPending: function(result) {
                            /* You may add your own implementation here */
                            // alert("wating your payment!");
                            // console.log(result);
                            window.location.href = "{{ route('user.bookings.index') }}";
                        },
                        onError: function(result) {
                            /* You may add your own implementation here */
                            // alert("payment failed!");
                            // console.log(result);
                            window.location.reload();
                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            // alert('you closed the popup without finishing the payment');
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
</div>

</main>