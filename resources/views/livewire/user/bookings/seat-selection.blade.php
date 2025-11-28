<div>
    <div class="container mx-auto p-4 sm:p-8 bg-slate-900 text-white">
        @if ($showtime->film && $showtime->studio)
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-amber-400">{{ $showtime->film->title }}</h1>
                <p class="text-lg text-slate-300">{{ $showtime->date->format('l, d F Y') }} at {{ $showtime->time->format('H:i') }}</p>
                <p class="text-md text-slate-400">Studio: {{ $showtime->studio->name }}</p>
            </div>

            <div class="flex justify-center mb-8">
            <div class="w-full max-w-4xl">
                <div class="bg-slate-800 rounded-t-lg py-2 text-center text-slate-300 tracking-widest">SCREEN</div>
                <div class="py-10 px-4 sm:px-10 bg-slate-800 rounded-b-lg">
                    @foreach ($seats as $row)
                        <div class="flex justify-center items-center gap-2 mb-2">
                            @foreach ($row as $seat)
                                @if ($seat['status'] === 'space')
                                    <div class="w-8 h-8"></div>
                                @else
                                    <button
                                        wire:click="toggleSeat('{{ $seat['number'] }}')"
                                        class="w-8 h-8 rounded-lg text-white flex items-center justify-center
                                            @if ($seat['status'] === 'booked')
                                                bg-red-500 cursor-not-allowed
                                            @elseif (in_array($seat['number'], $selectedSeats))
                                                bg-yellow-500
                                            @else
                                                bg-green-500 hover:bg-green-600
                                            @endif
                                        "
                                        @if ($seat['status'] === 'booked')
                                            disabled
                                        @endif
                                    >
                                        {{ $seat['number'] }}
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex justify-center space-x-6 mb-8">
            <div class="flex items-center">
                <div class="w-5 h-5 rounded-t-lg bg-slate-700 mr-2"></div>
                <span>Available</span>
            </div>
            <div class="flex items-center">
                <div class="w-5 h-5 rounded-t-lg bg-amber-500 mr-2"></div>
                <span>Selected</span>
            </div>
            <div class="flex items-center">
                <div class="w-5 h-5 rounded-t-lg bg-slate-600 mr-2"></div>
                <span>Booked</span>
            </div>
        </div>

        <div class="mt-8 p-4 border border-slate-700 rounded-lg bg-slate-800 max-w-4xl mx-auto">
            <h3 class="text-xl font-semibold mb-4 text-amber-400">Booking Summary</h3>
            @if (session()->has('error'))
                <div class="bg-red-900/50 border border-red-700 text-red-300 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <div class="mb-4 sm:mb-0">
                    <p class="text-lg">Selected Seats: <span class="font-bold text-amber-400">{{ count($selectedSeats) > 0 ? implode(', ', $selectedSeats) : 'None' }}</span></p>
                    <p class="text-lg">Total Price: <span class="font-bold text-amber-400">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span></p>
                </div>
                <button
                    wire:click="proceedToBooking"
                    wire:loading.attr="disabled"
                    class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-3 px-8 rounded-lg disabled:bg-slate-600 disabled:cursor-not-allowed transition-colors"
                    {{ count($selectedSeats) === 0 ? 'disabled' : '' }}
                >
                    <span wire:loading.remove>Proceed to Book</span>
                    <span wire:loading>Processing...</span>
                </button>
            </div>
        </div>
        @else
            <div class="text-center">
                <h1 class="text-3xl font-bold text-red-500">Error</h1>
                <p class="text-lg text-slate-300">Showtime details are currently unavailable. Please try again later.</p>
            </div>
        @endif
    </div>
</div>
