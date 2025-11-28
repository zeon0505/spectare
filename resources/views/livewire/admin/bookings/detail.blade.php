<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-amber-500 mb-2 drop-shadow-md">
                Detail Booking
            </h1>
            <p class="text-gray-400 text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-slate-500" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
                Studio: <span class="text-white font-semibold ml-1">{{ $booking->showtime->studio->name }}</span>
            </p>
        </div>

        <div class="mt-4 sm:mt-0">
            @if (!$isEditingSeats)
                <button wire:click="editSeats"
                    class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-lg transition-all shadow-lg shadow-amber-500/20 hover:scale-105">
                    Edit Kursi
                </button>
            @else
                <div class="flex space-x-3">
                    <button wire:click="updateSeats"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 px-6 rounded-lg text-sm transition-all shadow-lg hover:scale-105">
                        Simpan Perubahan
                    </button>
                    <button wire:click="cancelEdit"
                        class="border border-slate-600 text-gray-400 hover:bg-slate-700 hover:text-white font-semibold py-2.5 px-6 rounded-lg text-sm transition-all">
                        Batal
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-8 overflow-hidden">

        <div class="w-full mb-12 relative">
            <div class="w-2/3 mx-auto h-3 bg-gradient-to-r from-slate-700 via-slate-500 to-slate-700 rounded-[50%] shadow-[0_10px_30px_rgba(255,255,255,0.1)]"></div>
            <div class="w-1/2 mx-auto h-16 bg-gradient-to-b from-white/5 to-transparent blur-xl absolute top-2 left-0 right-0"></div>
            <p class="text-center text-xs font-bold text-gray-500 mt-4 uppercase tracking-[0.3em]">Layar Bioskop</p>
        </div>

        <div class="flex justify-center overflow-x-auto pb-4">
            <div class="flex flex-col gap-3">
                @if (empty($seatsLayout))
                    <p class="text-slate-400 text-center">Layout kursi untuk studio ini tidak tersedia.</p>
                @else
                    @foreach ($seatsLayout as $rowIndex => $row)
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-10 flex-shrink-0 flex items-center justify-center font-bold text-slate-500 text-lg">{{ chr(65 + $rowIndex) }}</div>
                            @foreach ($row as $seat)
                                @if ($seat['status'] === 'space')
                                    <div class="w-10 h-10 flex-shrink-0"></div>
                                @else
                                    @php
                                        $isCurrentBookingSeat = $seat['status'] === 'this_booking';
                                        $isBookedByOther = $seat['status'] === 'booked';
                                        $isSelectedInEdit = $isEditingSeats && in_array($seat['number'], $selectedSeats);

                                        $seatClass = 'bg-green-600 hover:bg-green-500 border-green-500';
                                        $isDisabled = false;
                                        $wireClickAction = "toggleSeat('{$seat['number']}')";

                                        if ($isBookedByOther) {
                                            $seatClass = 'bg-red-600 border-red-800 opacity-50 cursor-not-allowed';
                                            $isDisabled = true;
                                            $wireClickAction = null;
                                        }

                                        if ($isCurrentBookingSeat && !$isEditingSeats) {
                                            $seatClass = 'bg-amber-500 border-amber-300 shadow-[0_0_10px_rgba(245,158,11,0.5)]';
                                        }

                                        if ($isEditingSeats) {
                                            if ($isSelectedInEdit) {
                                                $seatClass = 'bg-amber-500 border-amber-300 ring-2 ring-amber-400 shadow-[0_0_10px_rgba(245,158,11,0.5)]';
                                            } elseif ($isBookedByOther) {
                                                $seatClass = 'bg-red-600 border-red-800 opacity-50 cursor-not-allowed';
                                                $isDisabled = true;
                                                $wireClickAction = null;
                                            } else {
                                                $seatClass = 'bg-green-600 hover:bg-green-500 border-green-500';
                                            }
                                        } else {
                                            $wireClickAction = null;
                                        }
                                    @endphp

                                    <button
                                        @if($wireClickAction) wire:click="{{ $wireClickAction }}" @endif
                                        class="w-10 h-10 flex-shrink-0 rounded-t-lg border-t-2 transition-all duration-150 {{ $seatClass }}"
                                        @if($isDisabled) disabled @endif
                                    >
                                        <span class="text-xs font-bold text-white/50">{{ $seat['number'] }}</span>
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="mt-10 border-t border-slate-700 pt-6 flex flex-wrap justify-center gap-6 md:gap-10">
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-t-lg bg-amber-500 border-t-2 border-amber-300 shadow-[0_0_10px_rgba(245,158,11,0.5)] mr-3"></div>
                <span class="text-sm text-gray-300 font-medium">
                    {{ $isEditingSeats ? 'Dipilih' : 'Kursi Anda' }}
                </span>
            </div>
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-t-lg bg-green-600 border-t-2 border-green-500 mr-3"></div>
                <span class="text-sm text-gray-300 font-medium">Tersedia</span>
            </div>
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-t-lg bg-red-600 border-t-2 border-red-800 opacity-50 mr-3"></div>
                <span class="text-sm text-gray-500 font-medium">Tidak Tersedia</span>
            </div>
        </div>
    </div>
</div>
