<main class="flex-1 overflow-auto">
            <!-- HEADER -->
            <header class="bg-gradient-to-r from-slate-900 to-slate-800 border-b border-amber-500/20 sticky top-0 z-30">
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="flex items-center space-x-4">
                        <button class="hamburger md:hidden text-amber-400 hover:text-amber-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h2 class="text-2xl font-bold text-white">Welcome back, {{ Auth::user()->name }}</h2>
                    </div>
                    <div class="flex items-center space-x-6">
                        <button class="relative text-gray-300 hover:text-amber-400 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center cursor-pointer hover:shadow-lg hover:shadow-amber-500/50 transition-all">
                            <span class="text-sm font-bold text-slate-900">JD</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <div class="p-8">
                <!-- STATS GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="stat-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm mb-2">Total Bookings</p>
                                <p class="text-3xl font-bold accent-amber">0</p>
                                <p class="text-xs text-gray-400 mt-2">0 from last month</p>
                            </div>
                            <div class="w-12 h-12 rounded-lg bg-amber-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 accent-amber" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm mb-2">Revenue</p>
                                <p class="text-3xl font-bold accent-amber">$0</p>
                                <p class="text-xs text-gray-400 mt-2">0 from last month</p>
                            </div>
                            <div class="w-12 h-12 rounded-lg bg-amber-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 accent-amber" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm mb-2">Active Shows</p>
                                <p class="text-3xl font-bold accent-amber">0</p>
                                <p class="text-xs text-gray-400 mt-2">0 this week</p>
                            </div>
                            <div class="w-12 h-12 rounded-lg bg-amber-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 accent-amber" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm mb-2">Occupancy Rate</p>
                                <p class="text-3xl font-bold accent-amber">0%</p>
                                <p class="text-xs text-gray-400 mt-2">0% from last week</p>
                            </div>
                            <div class="w-12 h-12 rounded-lg bg-amber-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 accent-amber" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FEATURED SECTION -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <div class="lg:col-span-2 card-cinema card-hover p-6 rounded-lg">
                        <h3 class="text-xl font-bold text-white mb-4">Now Showing</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @forelse($nowShowingFilms as $film)
                                <div class="bg-slate-800/50 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                                    <div class="h-40 bg-gradient-to-br from-amber-500/20 to-red-500/20 flex items-center justify-center overflow-hidden">
                                        <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" 
                                             alt="{{ $film->title }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-bold text-white mb-1">{{ $film->title }}</h4>
                                        <p class="text-xs text-gray-400">
                                            {{ $film->genres->pluck('name')->implode(' • ') }} • {{ $film->duration }}m
                                        </p>
                                        <div class="flex items-center justify-between mt-3">
                                            <span class="text-sm accent-amber font-semibold">Rp {{ number_format($film->ticket_price, 0, ',', '.') }}</span>
                                            <a href="{{ route('user.films.show', $film) }}" 
                                               class="px-3 py-1 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors text-xs">
                                                Book
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2 text-center py-8">
                                    <p class="text-gray-400">No films currently showing</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="card-cinema card-hover p-6 rounded-lg">
                        <h3 class="text-xl font-bold text-white mb-4">Quick Stats</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Avg. Ticket Price</span>
                                <span class="font-semibold accent-amber">Rp.0</span>
                            </div>
                            <div class="h-px bg-slate-700"></div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Total Screens</span>
                                <span class="font-semibold accent-amber">0</span>
                            </div>
                            <div class="h-px bg-slate-700"></div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Peak Hours</span>
                                <span class="font-semibold accent-amber">7-10 PM</span>
                            </div>
                            <div class="h-px bg-slate-700"></div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Weekend Sales</span>
                                <span class="font-semibold text-green-400">0%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UPCOMING EVENTS -->
                <div class="card-cinema card-hover p-6 rounded-lg">
                    <h3 class="text-xl font-bold text-white mb-4">Upcoming Events</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-4 bg-slate-800/30 rounded-lg border border-slate-700/50">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded bg-amber-500/20 flex items-center justify-center">
                                    <span class="text-amber-400 font-bold">🎬</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Movie Night - The Box Office Kings</p>
                                    <p class="text-xs text-gray-400">December 15, 2024 • 7:00 PM</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-amber-500/20 hover:bg-amber-500/30 text-amber-400 rounded font-semibold transition-colors text-xs">Attend</button>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-slate-800/30 rounded-lg border border-slate-700/50">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded bg-blue-500/20 flex items-center justify-center">
                                    <span class="text-blue-400 font-bold">🎭</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Special Screening - Classic Cinema</p>
                                    <p class="text-xs text-gray-400">December 18, 2024 • 8:30 PM</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-blue-500/20 hover:bg-blue-500/30 text-blue-400 rounded font-semibold transition-colors text-xs">Attend</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <footer class="border-t border-slate-700/50 bg-slate-900/50 py-6 px-8 mt-8">
                <div class="flex flex-col md:flex-row items-center justify-between text-gray-400 text-sm">
                    <p>&copy; 2025 Spectare Dashboard. All rights reserved.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-amber-400 transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-amber-400 transition-colors">Terms of Service</a>
                        <a href="#" class="hover:text-amber-400 transition-colors">Contact Us</a>
                    </div>
                </div>
            </footer>
        </main>
