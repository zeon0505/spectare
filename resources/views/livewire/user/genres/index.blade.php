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
                        <h2 class="text-2xl font-bold text-white">Film Genres</h2>
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
                <!-- GENRES GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Genre Card 1 -->
                    <div class="genre-card card-cinema card-hover rounded-lg overflow-hidden cursor-pointer group">
                        <div class="relative h-48 bg-gradient-to-br from-amber-500/20 to-red-500/20 flex items-center justify-center overflow-hidden">
                            <svg class="w-16 h-16 text-amber-400/40 group-hover:text-amber-400/60 transition-all" fill="currentColor" viewBox="0 0 24 24"><path d="M11.99 5V1h-1v4zm6.93 2.5l2.83-2.83-.707-.707-2.83 2.83zm0 7.07l2.83 2.83.707-.707-2.83-2.83zM6.05 18.36l2.83-2.83-.707-.707-2.83 2.83zm0-7.07l-2.83-2.83-.707.707 2.83 2.83zM5.07 7.5l-2.83-2.83-.707.707L4.36 8.21zM19 13h-4v-2h4zM7 13H3v-2h4zm14-6h-4V5h4zM7 7H3V5h4z"/></svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Action</h3>
                            <p class="text-sm text-gray-400 mb-4">892 Films</p>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors text-sm">Explore</button>
                        </div>
                    </div>

                    <!-- Genre Card 2 -->
                    <div class="genre-card card-cinema card-hover rounded-lg overflow-hidden cursor-pointer group">
                        <div class="relative h-48 bg-gradient-to-br from-purple-500/20 to-pink-500/20 flex items-center justify-center overflow-hidden">
                            <svg class="w-16 h-16 text-pink-400/40 group-hover:text-pink-400/60 transition-all" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Romance</h3>
                            <p class="text-sm text-gray-400 mb-4">654 Films</p>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors text-sm">Explore</button>
                        </div>
                    </div>

                    <!-- Genre Card 3 -->
                    <div class="genre-card card-cinema card-hover rounded-lg overflow-hidden cursor-pointer group">
                        <div class="relative h-48 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 flex items-center justify-center overflow-hidden">
                            <svg class="w-16 h-16 text-blue-400/40 group-hover:text-blue-400/60 transition-all" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/></svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Comedy</h3>
                            <p class="text-sm text-gray-400 mb-4">567 Films</p>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors text-sm">Explore</button>
                        </div>
                    </div>

                    <!-- Genre Card 4 -->
                    <div class="genre-card card-cinema card-hover rounded-lg overflow-hidden cursor-pointer group">
                        <div class="relative h-48 bg-gradient-to-br from-red-500/20 to-orange-500/20 flex items-center justify-center overflow-hidden">
                            <svg class="w-16 h-16 text-red-400/40 group-hover:text-red-400/60 transition-all" fill="currentColor" viewBox="0 0 24 24"><path d="M15.5 1h-8C6.12 1 5 2.12 5 3.5v17C5 21.88 6.12 23 7.5 23h8c1.38 0 2.5-1.12 2.5-2.5v-17C18 2.12 16.88 1 15.5 1zm-4 21c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4.5-4H7V4h9v14z"/></svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Horror</h3>
                            <p class="text-sm text-gray-400 mb-4">423 Films</p>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors text-sm">Explore</button>
                        </div>
                    </div>

                    <!-- Genre Card 5 -->
                    <div class="genre-card card-cinema card-hover rounded-lg overflow-hidden cursor-pointer group">
                        <div class="relative h-48 bg-gradient-to-br from-green-500/20 to-emerald-500/20 flex items-center justify-center overflow-hidden">
                            <svg class="w-16 h-16 text-green-400/40 group-hover:text-green-400/60 transition-all" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54-1.3-1.54c-.3-.36-.77-.36-1.06 0-.3.36-.3.94 0 1.3l1.83 2.17c.3.36.77.36 1.06 0L20.09 7.3c.3-.36.3-.94 0-1.3-.3-.36-.77-.36-1.06 0l-3.07 3.69z"/></svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Documentary</h3>
                            <p class="text-sm text-gray-400 mb-4">234 Films</p>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors text-sm">Explore</button>
                        </div>
                    </div>

                    <!-- Genre Card 6 -->
                    <div class="genre-card card-cinema card-hover rounded-lg overflow-hidden cursor-pointer group">
                        <div class="relative h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center overflow-hidden">
                            <svg class="w-16 h-16 text-indigo-400/40 group-hover:text-indigo-400/60 transition-all" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-11-5z"/></svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Thriller</h3>
                            <p class="text-sm text-gray-400 mb-4">389 Films</p>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors text-sm">Explore</button>
                        </div>
                    </div>

                    <!-- Genre Card 7 -->
                    <div class="genre-card card-cinema card-hover rounded-lg overflow-hidden cursor-pointer group">
                        <div class="relative h-48 bg-gradient-to-br from-yellow-500/20 to-orange-500/20 flex items-center justify-center overflow-hidden">
                            <svg class="w-16 h-16 text-yellow-400/40 group-hover:text-yellow-400/60 transition-all" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Drama</h3>
                            <p class="text-sm text-gray-400 mb-4">756 Films</p>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors text-sm">Explore</button>
                        </div>
                    </div>

                    <!-- Genre Card 8 -->
                    <div class="genre-card card-cinema card-hover rounded-lg overflow-hidden cursor-pointer group">
                        <div class="relative h-48 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 flex items-center justify-center overflow-hidden">
                            <svg class="w-16 h-16 text-cyan-400/40 group-hover:text-cyan-400/60 transition-all" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5z"/></svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Sci-Fi</h3>
                            <p class="text-sm text-gray-400 mb-4">621 Films</p>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors text-sm">Explore</button>
                        </div>
                    </div>
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
