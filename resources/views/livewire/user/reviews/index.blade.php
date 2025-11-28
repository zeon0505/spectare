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
                        <h2 class="text-2xl font-bold text-white">Film Reviews</h2>
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
                <!-- SORT OPTIONS -->
                <div class="card-cinema card-hover p-6 rounded-lg mb-8">
                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="flex-1">
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Filter by Film</label>
                            <input type="text" placeholder="Search films..." class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:border-amber-500/50">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Sort By</label>
                            <select class="bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-amber-500/50">
                                <option>Latest</option>
                                <option>Highest Rated</option>
                                <option>Lowest Rated</option>
                                <option>Most Helpful</option>
                            </select>
                        </div>
                        <button class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded-lg transition-colors">Apply</button>
                    </div>
                </div>

                <!-- REVIEWS LIST -->
                <div class="space-y-6">
                    @forelse ($reviews as $review)
                        <div class="review-card card-cinema card-hover p-6 rounded-lg">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    @if ($review->user->profile_photo_path)
                                        <img src="{{ asset('storage/' . $review->user->profile_photo_path) }}" alt="{{ $review->user->name }} avatar" class="w-12 h-12 rounded-full object-cover">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center">
                                            <span class="text-lg font-bold text-slate-900">{{ strtoupper(substr($review->user->name, 0, 2)) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="text-lg font-bold text-white">{{ $review->film->title }}</h3>
                                        <p class="text-xs text-gray-400">By {{ $review->user->name }} • {{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="flex items-center justify-end mb-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.368-2.448a1 1 0 00-1.175 0l-3.368 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.05 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.368-2.448a1 1 0 00-1.175 0l-3.368 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.05 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-sm font-semibold accent-amber">{{ number_format($review->rating, 1) }}/5</span>
                                </div>
                            </div>
                            <p class="text-gray-300 leading-relaxed mb-4">{{ $review->comment }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-4">
                                    {{-- Placeholder for Like/Dislike buttons --}}
                                </div>
                                <button class="px-4 py-1 bg-amber-500/20 hover:bg-amber-500/30 text-amber-400 rounded text-sm font-semibold transition-colors">Report</button>
                            </div>
                        </div>
                    @empty
                        <div class="card-cinema p-6 rounded-lg text-center">
                            <p class="text-gray-400">No reviews found for this film yet.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $reviews->links() }}
                </div>
            </div>

            <!-- FOOTER -->
            <footer class="border-t border-slate-700/50 bg-slate-900/50 py-6 px-8 mt-8">
                <div class="flex flex-col md:flex-row items-center justify-between text-gray-400 text-sm">
                    <p>&copy; 2025 Spectare Cinema. All rights reserved.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-amber-400 transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-amber-400 transition-colors">Terms of Service</a>
                        <a href="#" class="hover:text-amber-400 transition-colors">Contact Us</a>
                    </div>
                </div>
            </footer>
        </main>
