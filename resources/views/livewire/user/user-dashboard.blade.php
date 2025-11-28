<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-2 drop-shadow-md">User Dashboard</h1>
        <p class="text-gray-400 text-sm">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Recent Bookings --}}
        <div class="lg:col-span-2">
            <h2 class="text-xl font-bold text-white mb-4">Recent Bookings</h2>
            <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">
                @if($recentBookings->count() > 0)
                    <ul class="divide-y divide-slate-700">
                        @foreach($recentBookings as $booking)
                            <li class="p-4 hover:bg-slate-700/30 transition-colors duration-200">
                                <a href="{{ route('user.bookings.detail', $booking->id) }}" class="block">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-16 h-24 shadow-md rounded-lg overflow-hidden border border-slate-600">
                                            <img class="w-full h-full object-cover"
                                                 src="{{ Str::startsWith($booking->showtime->film->poster_url, 'http') ? $booking->showtime->film->poster_url : Storage::url($booking->showtime->film->poster_url) }}"
                                                 alt="{{ $booking->showtime->film->title }}">
                                        </div>
                                        <div class="ml-4 flex-grow">
                                            <div class="flex justify-between">
                                                <div>
                                                    <p class="font-bold text-white">{{ $booking->showtime->film->title }}</p>
                                                    <p class="text-sm text-gray-400">{{ $booking->showtime->studio->name }} - {{ $booking->showtime->start_time->format('d M Y, H:i') }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-bold text-amber-500">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                                    <span class="text-xs px-2 py-1 rounded-full
                                                        @if($booking->status == 'paid') bg-green-500/20 text-green-400
                                                        @elseif($booking->status == 'pending') bg-yellow-500/20 text-yellow-400
                                                        @else bg-red-500/20 text-red-400 @endif">
                                                        {{ ucfirst($booking->status) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400 p-4">You have no recent bookings.</p>
                @endif
            </div>
        </div>

        {{-- Recent Snack Orders & Reviews --}}
        <div>
            {{-- My Profile Link --}}
            <div class="mb-8">
                <h2 class="text-xl font-bold text-white mb-4">My Profile</h2>
                <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-4">
                    <p class="text-gray-400 mb-4">Manage your profile information, password, and profile picture.</p>
                    <a href="{{ route('profile') }}" class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 active:bg-amber-700 focus:outline-none focus:border-amber-700 focus:ring focus:ring-amber-300 disabled:opacity-25 transition">
                        Edit Profile
                    </a>
                </div>
            </div>

            {{-- Snack Orders --}}
            <div>
                <h2 class="text-xl font-bold text-white mb-4">Recent Snack Orders</h2>
                <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">
                    @if($recentSnackOrders->count() > 0)
                        <ul class="divide-y divide-slate-700">
                            @foreach($recentSnackOrders as $order)
                                <li class="p-4 hover:bg-slate-700/30 transition-colors duration-200">
                                    <a href="{{ route('user.transactions.detail', $order->id) }}" class="block">
                                        <div class="flex justify-between">
                                            <p class="font-bold text-white">Order #{{ $order->id }}</p>
                                            <p class="font-bold text-amber-500">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="text-sm text-gray-400">{{ $order->created_at->format('d M Y') }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400 p-4">You have no recent snack orders.</p>
                    @endif
                </div>
            </div>

            {{-- Reviews --}}
            <div class="mt-8">
                <h2 class="text-xl font-bold text-white mb-4">Your Recent Reviews</h2>
                <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">
                    @if($recentReviews->count() > 0)
                        <ul class="divide-y divide-slate-700">
                            @foreach($recentReviews as $review)
                                <li class="p-4">
                                    <p class="font-bold text-white">{{ $review->film->title }}</p>
                                    <p class="text-sm text-gray-400 italic">"{{ Str::limit($review->comment, 50) }}"</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400 p-4">You have not written any reviews yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
