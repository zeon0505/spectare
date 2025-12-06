<aside class="sidebar w-64 bg-gradient-to-b from-slate-900 to-slate-950 border-r border-amber-500/20 overflow-y-auto">
    <div class="p-6">
        <div class="flex items-center space-x-3 mb-8">
            @auth
                <a href="{{ route('profile') }}" wire:navigate class="flex items-center space-x-3">
                    @if (Auth::user()->profile_photo_path)
                        <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover border-2 border-amber-500">
                    @else
                        <div class="h-10 w-10 rounded-full bg-gray-600 flex items-center justify-center text-white font-bold text-lg">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                    <h1 class="text-xl font-bold text-white">{{ Auth::user()->name }}</h1>
                </a>
            @else
                <a href="{{ route('home') }}" wire:navigate class="flex items-center space-x-3">
                    @php
                        $logo = \App\Models\SiteSetting::get('logo');
                    @endphp
                    @if($logo)
                        <img src="{{ str_starts_with($logo, 'http') ? $logo : Storage::url($logo) }}" alt="Spectare Logo" class="h-10 w-auto">
                    @else
                        <img src="{{ asset('images/logo.png') }}" alt="Spectare Logo" class="h-10 w-auto">
                    @endif
                    <h1 class="text-xl font-bold accent-amber">Spectare</h1>
                </a>
            @endauth
        </div>

        <nav class="space-y-2" x-data="{ 
            contentOpen: {{ request()->routeIs('admin.films.*') || request()->routeIs('admin.genres.*') || request()->routeIs('admin.showtimes.*') || request()->routeIs('admin.studios.*') ? 'true' : 'false' }},
            operationsOpen: {{ request()->routeIs('admin.bookings.*') || request()->routeIs('admin.transactions.*') || request()->routeIs('admin.snacks.*') || request()->routeIs('admin.reviews.*') ? 'true' : 'false' }},
            settingsOpen: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }},
            myAccountOpen: {{ request()->routeIs('user.bookings.*') || request()->routeIs('user.wishlist.*') ? 'true' : 'false' }},
            browseOpen: {{ request()->routeIs('user.films.*') || request()->routeIs('user.showtimes.*') || request()->routeIs('user.studios.*') || request()->routeIs('user.snacks.*') ? 'true' : 'false' }}
        }">
            <div class="text-xs font-semibold text-gray-400 uppercase mb-4 flex justify-between items-center">
                <span>Menu</span>
                @guest
                    @livewire('user.snacks.cart-icon')
                @endguest
                @auth
                    @if(Auth::user()->role !== 'admin')
                        @livewire('user.snacks.cart-icon')
                    @endif
                @endauth
            </div>

            {{-- Guest Menu --}}
            @guest
                <a href="{{ route('home') }}" wire:navigate
                    class="menu-item active block px-4 py-3 rounded-lg transition-all duration-300">
                    <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                    </svg>
                    Home
                </a>
                <a href="{{ route('films.index') }}" wire:navigate
                    class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                    <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                    </svg>
                    Films
                </a>
            @endguest

            {{-- Authenticated User Menu --}}
            @auth
                @if (Auth::user()->role === 'admin')
                    {{-- Admin Menu --}}
                    <a href="{{ route('admin.dashboard') }}" wire:navigate
                        class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.reports.index') }}" wire:navigate
                        class="menu-item {{ request()->routeIs('admin.reports.index') ? 'active' : '' }} block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Reports
                    </a>

                    {{-- Content Management Dropdown --}}
                    <div class="space-y-1">
                        <button @click="contentOpen = !contentOpen" 
                                class="menu-item w-full text-left px-4 py-3 rounded-lg transition-all duration-300 flex items-center justify-between"
                                :class="contentOpen ? 'bg-slate-700' : ''">
                            <div class="flex items-center">
                                <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                                </svg>
                                <span>Content</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="contentOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="contentOpen" x-collapse class="ml-4 space-y-1">
                            <a href="{{ route('admin.films.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.films.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Films
                            </a>
                            <a href="{{ route('admin.genres.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.genres.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Genres
                            </a>
                            <a href="{{ route('admin.showtimes.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.showtimes.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Showtimes
                            </a>
                            <a href="{{ route('admin.studios.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.studios.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Studios
                            </a>
                            <a href="{{ route('admin.content.featured') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.content.featured') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Featured Films
                            </a>
                        </div>
                    </div>

                    {{-- Operations Dropdown --}}
                    <div class="space-y-1">
                        <button @click="operationsOpen = !operationsOpen" 
                                class="menu-item w-full text-left px-4 py-3 rounded-lg transition-all duration-300 flex items-center justify-between"
                                :class="operationsOpen ? 'bg-slate-700' : ''">
                            <div class="flex items-center">
                                <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Operations</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="operationsOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="operationsOpen" x-collapse class="ml-4 space-y-1">
                            <a href="{{ route('admin.bookings.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Bookings
                            </a>
                            <a href="{{ route('admin.transactions.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Transactions
                            </a>
                            <a href="{{ route('admin.snacks.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.snacks.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Snacks
                            </a>
                            <a href="{{ route('admin.reviews.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Reviews
                            </a>
                            <a href="{{ route('admin.vouchers.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.vouchers.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Vouchers
                            </a>
                        </div>
                    </div>

                    {{-- Settings Dropdown --}}
                    <div class="space-y-1">
                        <button @click="settingsOpen = !settingsOpen" 
                                class="menu-item w-full text-left px-4 py-3 rounded-lg transition-all duration-300 flex items-center justify-between"
                                :class="settingsOpen ? 'bg-slate-700' : ''">
                            <div class="flex items-center">
                                <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Settings</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="settingsOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="settingsOpen" x-collapse class="ml-4 space-y-1">
                            <a href="{{ route('admin.users.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Users
                            </a>
                            <a href="{{ route('admin.settings.site') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Site Settings
                            </a>
                        </div>
                    </div>

                @else
                    {{-- Regular User Menu --}}
                    <a href="{{ route('user.dashboard') }}" wire:navigate
                        class="menu-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }} block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                        </svg>
                        Dashboard
                    </a>

                    {{-- My Account Dropdown --}}
                    <div class="space-y-1">
                        <button @click="myAccountOpen = !myAccountOpen" 
                                class="menu-item w-full text-left px-4 py-3 rounded-lg transition-all duration-300 flex items-center justify-between"
                                :class="myAccountOpen ? 'bg-slate-700' : ''">
                            <div class="flex items-center">
                                <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <span>My Account</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="myAccountOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="myAccountOpen" x-collapse class="ml-4 space-y-1">
                            <a href="{{ route('user.bookings.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('user.bookings.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Bookings
                            </a>
                            <a href="{{ route('user.wishlist.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('user.wishlist.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Wishlist
                            </a>
                        </div>
                    </div>

                    {{-- Browse Dropdown --}}
                    <div class="space-y-1">
                        <button @click="browseOpen = !browseOpen" 
                                class="menu-item w-full text-left px-4 py-3 rounded-lg transition-all duration-300 flex items-center justify-between"
                                :class="browseOpen ? 'bg-slate-700' : ''">
                            <div class="flex items-center">
                                <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                                </svg>
                                <span>Browse</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="browseOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="browseOpen" x-collapse class="ml-4 space-y-1">
                            <a href="{{ route('user.films.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('user.films.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Films
                            </a>
                            <a href="{{ route('user.showtimes.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('user.showtimes.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Showtimes
                            </a>
                            <a href="{{ route('user.studios.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('user.studios.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Studios
                            </a>
                            <a href="{{ route('user.snacks.index') }}" wire:navigate
                                class="menu-item {{ request()->routeIs('user.snacks.*') ? 'active' : '' }} block px-4 py-2 rounded-lg transition-all duration-300 text-sm">
                                Snacks
                            </a>
                        </div>
                    </div>
                @endif

                {{-- Common Authenticated Menu Items --}}
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <button type="button" onclick="confirmLogout()"
                        class="menu-item block w-full text-left px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                        </svg>
                        Logout
                    </button>
                </form>

                <script>
                function confirmLogout() {
                    Swal.fire({
                        title: 'Logout',
                        text: 'Apakah Anda yakin ingin keluar?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#f59e0b',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Keluar',
                        cancelButtonText: 'Batal',
                        background: '#1e293b',
                        color: '#f1f5f9',
                        customClass: {
                            popup: 'border border-amber-500/20'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form').submit();
                        }
                    });
                }
                </script>
            @endauth
        </nav>
    </div>
</aside>
