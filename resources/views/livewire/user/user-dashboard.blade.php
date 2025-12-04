<div class="min-h-screen bg-slate-950 text-white font-sans">
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
    </style>

    <div class="pb-12">
        <!-- Auto-Rotating Hero Slider -->
        @if($nowShowingFilms->isNotEmpty())
            <div class="relative w-full h-[600px] overflow-hidden" x-data="heroSlider({{ $nowShowingFilms->count() }})">
                <!-- Slides Container -->
                @foreach($nowShowingFilms->take(5) as $index => $film)
                    <div class="absolute inset-0 transition-opacity duration-1000"
                         :class="currentSlide === {{ $index }} ? 'opacity-100 z-10' : 'opacity-0 z-0'">
                        <!-- Background Image with Gradient -->
                        <div class="absolute inset-0">
                            <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" 
                                 class="w-full h-full object-cover opacity-50"
                                 alt="{{ $film->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/80 to-slate-950/20"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/60 to-transparent"></div>
                        </div>

                        <!-- Content -->
                        <div class="absolute inset-0 flex items-center">
                            <div class="container mx-auto px-8 lg:px-16">
                                <div class="max-w-3xl">
                                    <div class="flex items-center space-x-3 mb-6 float-animation">
                                        <span class="px-4 py-2 bg-amber-500 text-slate-900 text-sm font-bold rounded-full uppercase tracking-wider shadow-lg shadow-amber-500/30">Now Showing</span>
                                        <span class="text-gray-300 text-sm flex items-center">
                                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            {{ $film->average_rating ? number_format($film->average_rating, 1) : 'N/A' }}
                                        </span>
                                        <span class="text-gray-300 text-sm">•</span>
                                        <span class="text-gray-300 text-sm">{{ $film->duration }} min</span>
                                    </div>
                                    
                                    <h1 class="text-6xl lg:text-7xl font-black text-white mb-6 leading-tight drop-shadow-2xl">
                                        {{ $film->title }}
                                    </h1>
                                    
                                    <p class="text-gray-300 mb-8 text-xl leading-relaxed line-clamp-3">
                                        {{ $film->description }}
                                    </p>
                                    
                                    <div class="flex flex-wrap items-center gap-4">
                                        <a href="{{ route('user.films.show', $film->id) }}" 
                                           class="group inline-flex items-center px-8 py-4 bg-amber-500 hover:bg-amber-400 text-slate-900 font-bold rounded-2xl transition-all transform hover:scale-105 shadow-2xl shadow-amber-500/30">
                                            <svg class="w-6 h-6 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"></path>
                                            </svg>
                                            Book Ticket Now
                                        </a>
                                        <a href="{{ route('user.films.show', $film->id) }}" class="inline-flex items-center px-8 py-4 bg-slate-800/80 hover:bg-slate-700 backdrop-blur-lg border border-slate-600 text-white font-semibold rounded-2xl transition-all">
                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            More Info
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Navigation Dots -->
                <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex space-x-3">
                    @foreach($nowShowingFilms->take(5) as $index => $film)
                        <button @click="goToSlide({{ $index }})" 
                                class="transition-all duration-300"
                                :class="currentSlide === {{ $index }} ? 'w-12 h-2 bg-amber-500' : 'w-2 h-2 bg-white/50 hover:bg-white/80'"
                                style="border-radius: 999px;">
                        </button>
                    @endforeach
                </div>

                <!-- Navigation Arrows -->
                <button @click="prevSlide()" 
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 z-20 bg-black/30 hover:bg-black/50 backdrop-blur-sm text-white p-3 rounded-full transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button @click="nextSlide()" 
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 z-20 bg-black/30 hover:bg-black/50 backdrop-blur-sm text-white p-3 rounded-full transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <script>
                function heroSlider(totalSlides) {
                    return {
                        currentSlide: 0,
                        totalSlides: totalSlides,
                        interval: null,
                        
                        init() {
                            this.startAutoPlay();
                        },
                        
                        startAutoPlay() {
                            this.interval = setInterval(() => {
                                this.nextSlide();
                            }, 5000); // Change slide every 5 seconds
                        },
                        
                        stopAutoPlay() {
                            if (this.interval) {
                                clearInterval(this.interval);
                            }
                        },
                        
                        nextSlide() {
                            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                        },
                        
                        prevSlide() {
                            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                            this.stopAutoPlay();
                            this.startAutoPlay();
                        },
                        
                        goToSlide(index) {
                            this.currentSlide = index;
                            this.stopAutoPlay();
                            this.startAutoPlay();
                        }
                    }
                }
            </script>
        @endif

        <!-- Content Container -->
        <div class="container mx-auto px-8 -mt-24 relative z-20">
            
            <!-- Your Bookings Section (Enhanced Horizontal Scroll) -->
            @if($recentBookings->count() > 0)
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-4xl font-black text-white mb-2">Your Bookings</h2>
                            <p class="text-gray-400">Track your cinema reservations</p>
                        </div>
                        <a href="{{ route('user.bookings.index') }}" 
                           class="inline-flex items-center text-amber-500 hover:text-amber-400 font-bold group">
                            View All
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="flex space-x-6 overflow-x-auto pb-4 scrollbar-hide">
                        @foreach($recentBookings as $booking)
                            <div class="flex-none w-96 relative group">
                                <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl overflow-hidden shadow-2xl border border-slate-700/50 transition-all duration-500 group-hover:border-amber-500/50 group-hover:transform group-hover:-translate-y-2 group-hover:shadow-amber-500/10">
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ Str::startsWith($booking->showtime->film->poster_url, 'http') ? $booking->showtime->film->poster_url : Storage::url($booking->showtime->film->poster_url) }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                                             alt="{{ $booking->showtime->film->title }}">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
                                        <div class="absolute top-4 right-4">
                                            <span class="px-3 py-1.5 bg-{{ $booking->status == 'paid' ? 'green' : 'yellow' }}-500 text-white text-xs font-bold rounded-full shadow-lg">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <h3 class="font-bold text-xl text-white mb-2 truncate group-hover:text-amber-400 transition-colors">
                                            {{ $booking->showtime->film->title }}
                                        </h3>
                                        <div class="flex items-center text-gray-400 text-sm mb-4">
                                            <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $booking->showtime->start_time->format('d M, H:i') }}
                                        </div>
                                        
                                        <div class="w-full bg-slate-700/50 rounded-full h-2 mb-4">
                                            <div class="bg-gradient-to-r from-amber-500 to-amber-400 h-2 rounded-full transition-all duration-1000" style="width: {{ $booking->status == 'paid' ? '100%' : '30%' }}"></div>
                                        </div>
                                        
                                        <a href="{{ route('user.bookings.detail', $booking->id) }}" 
                                           class="block w-full text-center py-3 bg-slate-800 hover:bg-amber-500 hover:text-slate-900 rounded-xl text-sm font-bold transition-all transform group-hover:scale-105">
                                            View Ticket
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Popular Now (Now Showing) - Enhanced Grid -->
            <div class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-4xl font-black text-white mb-2">Popular Now</h2>
                        <p class="text-gray-400">Trending movies everyone's watching</p>
                    </div>
                    <a href="{{ route('user.films.index') }}" 
                       class="inline-flex items-center text-amber-500 hover:text-amber-400 font-bold group">
                        Explore All
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($nowShowingFilms->take(10) as $film)
                        <a href="{{ route('user.films.show', $film->id) }}" class="group">
                            <div class="aspect-[2/3] rounded-2xl overflow-hidden bg-slate-900 relative shadow-2xl transition-all duration-500 group-hover:shadow-amber-500/30 group-hover:scale-105">
                                <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                     alt="{{ $film->title }}">
                                
                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <!-- Play Button Overlay -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                    <div class="w-16 h-16 rounded-full bg-amber-500 flex items-center justify-center transform scale-0 group-hover:scale-100 transition-transform duration-500 shadow-2xl">
                                        <svg class="w-8 h-8 text-slate-900 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <!-- Rating Badge -->
                                <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md px-2.5 py-1.5 rounded-lg flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="text-sm font-bold text-white">{{ $film->average_rating ? number_format($film->average_rating, 1) : 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h3 class="font-bold text-white truncate group-hover:text-amber-500 transition-colors text-lg">
                                    {{ $film->title }}
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $film->genres->pluck('name')->first() }} • {{ $film->duration }}m</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Coming Soon - Horizontal Carousel -->
            @if($comingSoonFilms->count() > 0)
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-4xl font-black text-white mb-2">Coming Soon</h2>
                            <p class="text-gray-400">Upcoming releases you don't want to miss</p>
                        </div>
                        <a href="{{ route('user.films.index') }}" 
                           class="inline-flex items-center text-amber-500 hover:text-amber-400 font-bold group">
                            See All
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="flex space-x-6 overflow-x-auto pb-4 scrollbar-hide">
                        @foreach($comingSoonFilms as $film)
                            <div class="flex-none w-56 group">
                                <div class="aspect-[2/3] rounded-2xl overflow-hidden bg-slate-900 relative shadow-xl">
                                    <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" 
                                         class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity duration-500" 
                                         alt="{{ $film->title }}">
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/50 backdrop-blur-sm">
                                        <span class="px-4 py-2 border-2 border-white text-white text-sm font-bold rounded-full uppercase tracking-wider">
                                            Coming Soon
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h3 class="font-bold text-white text-sm truncate">{{ $film->title }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">{{ $film->release_date->format('d M Y') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
