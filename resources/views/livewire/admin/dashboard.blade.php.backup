<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spectare - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(251, 191, 36, 0.3);
            }
            50% {
                box-shadow: 0 0 30px rgba(251, 191, 36, 0.5);
            }
        }

        .card-cinema {
            animation: fadeIn 0.6s ease-out forwards;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%);
            border: 1px solid rgba(251, 191, 36, 0.2);
            backdrop-filter: blur(10px);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            border-color: rgba(251, 191, 36, 0.6);
            box-shadow: 0 10px 40px rgba(251, 191, 36, 0.15);
        }

        .stat-card {
            animation: slideInLeft 0.7s ease-out forwards;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.3s;
        }

        .accent-amber {
            color: #fbbf24;
        }

        .text-glow {
            animation: glow 2s ease-in-out infinite;
        }

        .menu-item:hover {
            background-color: rgba(251, 191, 36, 0.1);
            color: #fbbf24;
        }

        .menu-item.active {
            background-color: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
            border-left: 3px solid #fbbf24;
        }

        .hamburger {
            display: none;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                position: fixed;
                left: 0;
                top: 0;
                z-index: 40;
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-gray-100">

    <div class="flex h-screen overflow-hidden">
        <!-- SIDEBAR -->
        <aside class="sidebar w-64 bg-gradient-to-b from-slate-900 to-slate-950 border-r border-amber-500/20 overflow-y-auto">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11z"/>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold accent-amber">Spectare</h1>
                </div>

                <nav class="space-y-2">
                    <div class="text-xs font-semibold text-gray-400 uppercase mb-4">Dashboard</div>

                    <a href="#" class="menu-item active block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Movies
                    </a>

                    <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Bookings
                    </a>
                     <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Booking Seat
                    </a>
                     <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Genre
                    </a>
                     <a href="{{ route('films.index') }}" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Film
                    </a>
                     <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Review
                    </a>
                     <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Showtime
                    </a>
                     <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Studio
                    </a>
                     <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Transaction
                    </a>

                    <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        Reports
                    </a>

                    <div class="text-xs font-semibold text-gray-400 uppercase my-4 pt-4 border-t border-slate-700">Settings</div>

                    <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.62l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94L14.4 2.81c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41L9.25 5.35C8.66 5.59 8.12 5.92 7.63 6.29L5.24 5.33c-.22-.08-.47 0-.59.22L2.74 8.87c-.13.21-.08.48.1.62l2.03 1.58c-.05.3-.07.62-.07.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.62l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.48-.12-.62l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                        </svg>
                        Settings
                    </a>

                    <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                        Support
                    </a>
                    <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                        Logout
                    </a>
                </nav>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
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
                                <p class="text-3xl font-bold accent-amber">Rp.0</p>
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
                            <div class="bg-slate-800/50 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                                <div class="h-40 bg-gradient-to-br from-amber-500/20 to-red-500/20 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-amber-400/30" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold text-white mb-1">High & Low The Worst</h4>
                                    <p class="text-xs text-gray-400">Action • 2h 15m</p>
                                    <div class="flex items-center justify-between mt-3">
                                        <span class="text-sm accent-amber font-semibold">Rp.40.000</span>
                                        <button class="px-3 py-1 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors text-xs">Book</button>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-slate-800/50 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                                <div class="h-40 bg-gradient-to-br from-purple-500/20 to-pink-500/20 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-purple-400/30" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                    </svg>
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold text-white mb-1">Weak Hero Class 1</h4>
                                    <p class="text-xs text-gray-400">Drama • 1h 58m</p>
                                    <div class="flex items-center justify-between mt-3">
                                        <span class="text-sm accent-amber font-semibold">Rp.40.000</span>
                                        <button class="px-3 py-1 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors text-xs">Book</button>
                                    </div>
                                </div>
                            </div>
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
    </div>

    <script>
        // Hamburger menu toggle
        const hamburger = document.querySelector('.hamburger');
        const sidebar = document.querySelector('.sidebar');

        hamburger?.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.sidebar') && !e.target.closest('.hamburger')) {
                sidebar.classList.remove('open');
            }
        });

    </script>
</body>
</html>
