
<div class="container mx-auto px-4 py-8">
    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">
        <div class="p-6 border-b border-slate-700">
            <h1 class="text-2xl font-bold text-white">Transaction Detail</h1>
            <p class="text-gray-400">Transaction #{{ $transaction->id }}</p>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-white mb-2">Booking Information</h2>
                    <div class="text-gray-300 space-y-2">
                        <p><span class="font-semibold">Film:</span> {{ $transaction->booking->showtime->film->title }}</p>
                        <p><span class="font-semibold">Studio:</span> {{ $transaction->booking->showtime->studio->name }}</p>
                        <p><span class="font-semibold">Showtime:</span> {{ $transaction->booking->showtime->start_time->format('d M Y, H:i') }}</p>
                        <p><span class="font-semibold">Seats:</span>
                            @foreach($transaction->booking->seats as $seat)
                                <span class="inline-block bg-amber-500 text-slate-900 font-bold text-xs px-2 py-1 rounded-md mr-1">{{ $seat->seat_number }}</span>
                            @endforeach
                        </p>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-white mb-2">Payment Details</h2>
                    <div class="text-gray-300 space-y-2">
                        <p><span class="font-semibold">Total Price:</span> <span class="font-bold text-amber-500">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span></p>
                        <p><span class="font-semibold">Payment Method:</span> {{ ucfirst($transaction->payment_method) }}</p>
                        <p><span class="font-semibold">Status:</span>
                            <span class="text-xs px-2 py-1 rounded-full
                                @if($transaction->status == 'paid') bg-green-500/20 text-green-400
                                @elseif($transaction->status == 'pending') bg-yellow-500/20 text-yellow-400
                                @else bg-red-500/20 text-red-400 @endif">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </p>
                        <p><span class="font-semibold">Transaction Time:</span> {{ $transaction->created_at->format('d M Y, H:i:s') }}</p>
                    </div>
                </div>
            </div>

            @if($transaction->booking->qr_code_path)
            <div class="mt-6 text-center">
                <h2 class="text-lg font-semibold text-white mb-2">Your QR Code</h2>
                <div class="flex justify-center">
                    <div class="bg-white p-4 rounded-lg">
                        <img src="{{ asset('storage/' . $transaction->booking->qr_code_path) }}" alt="Booking QR Code" class="w-48 h-48">
                    </div>
                </div>
                <p class="text-gray-400 mt-2">Show this QR code at the cinema.</p>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection
