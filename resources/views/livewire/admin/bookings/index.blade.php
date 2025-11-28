<div class="container mx-auto px-4">
<!-- Header: Match the style of Daftar Film header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
<!-- Text color white, font large and bold, using amber accent concept -->
<h1 class="text-4xl font-extrabold text-white mb-2 sm:mb-0">Daftar Pemesanan</h1>
</div>
<p class="mt-2 text-sm text-gray-400 mb-6">Kelola semua pemesanan tiket yang masuk.</p>

<!-- Table Container - Applied cinematic card style and responsive overflow -->
<div class="card-cinema p-4 md:p-6 rounded-xl overflow-x-auto shadow-2xl shadow-amber-900/30">
    <table class="min-w-full leading-normal text-gray-100">
        <thead>
            <tr>
                <!-- Table Header Style: Dark background, amber border, gray-400 text -->
                <th class="px-5 py-3 border-b border-amber-500/30 bg-slate-800/70 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider rounded-tl-lg">Kode Booking</th>
                <th class="px-5 py-3 border-b border-amber-500/30 bg-slate-800/70 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Pengguna</th>
                <th class="px-5 py-3 border-b border-amber-500/30 bg-slate-800/70 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Film</th>
                <th class="px-5 py-3 border-b border-amber-500/30 bg-slate-800/70 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Pesan</th>
                <th class="px-5 py-3 border-b border-amber-500/30 bg-slate-800/70 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                <th class="px-5 py-3 border-b border-amber-500/30 bg-slate-800/70 rounded-tr-lg"></th>
            </tr>
        </thead>
        <!-- Table Body Style: Dark cells, hover effect, light text -->
        <tbody class="divide-y divide-slate-700">
            @forelse ($bookings as $booking)
                <tr class="hover:bg-slate-700/50 transition-colors">
                    <td class="px-5 py-5 border-b border-slate-700 text-sm font-semibold text-gray-100">{{ $booking->booking_code }}</td>
                    <td class="px-5 py-5 border-b border-slate-700 text-sm text-gray-300">{{ $booking->user->name }}</td>
                    <td class="px-5 py-5 border-b border-slate-700 text-sm text-gray-300">{{ $booking->showtime->film->title }}</td>
                    <td class="px-5 py-5 border-b border-slate-700 text-sm text-gray-300">{{ $booking->created_at->format('d M Y, H:i') }}</td>
                    <td class="px-5 py-5 border-b border-slate-700 text-sm">
                        <!-- Status Badge Refactor for Dark Theme (darker background, lighter text) -->
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium
                            @switch($booking->status)
                                @case('paid') bg-green-900/50 text-green-300 ring-1 ring-inset ring-green-500/30 @break
                                @case('pending') bg-amber-900/50 text-amber-300 ring-1 ring-inset ring-amber-500/30 @break
                                @case('cancelled') bg-red-900/50 text-red-300 ring-1 ring-inset ring-red-500/30 @break
                            @endswitch">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-slate-700 text-sm text-right">
                        <!-- Action Link: Amber accent -->
                        <a href="{{ route('admin.bookings.detail', $booking) }}" class="text-amber-400 hover:text-amber-300 font-semibold transition-colors">Lihat Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-sm text-center text-gray-400 border-b border-slate-700">
                        Belum ada pemesanan yang masuk.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination links style matching the Daftar Film component -->
<div class="mt-6 p-4 text-center bg-slate-900/50 rounded-lg text-gray-400">
    {{ $bookings->links() }}
</div>


</div>
