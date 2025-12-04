<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="mb-10 text-center sm:text-left">
        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-300 drop-shadow-sm mb-3">
            Shopping Cart
        </h1>
        <p class="text-gray-400 text-lg">
            Review your selected snacks before checkout.
        </p>
    </div>

    @if(count($cartItems) > 0)
        <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-800">

                    <thead class="bg-slate-950/50">
                        <tr>
                            <th class="px-6 py-5 text-xs font-bold tracking-wider text-left text-gray-400 uppercase w-1/3">
                                Snack
                            </th>
                            <th class="px-6 py-5 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                Price
                            </th>
                            <th class="px-6 py-5 text-xs font-bold tracking-wider text-center text-gray-400 uppercase">
                                Quantity
                            </th>
                            <th class="px-6 py-5 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                                Total
                            </th>
                            <th class="px-6 py-5 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-800">
                        @foreach ($cartItems as $item)
                            <tr class="hover:bg-slate-800/50 transition-colors duration-200 group">

                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-20 h-20 shadow-lg rounded-xl overflow-hidden border border-slate-700 group-hover:border-amber-500/50 transition-colors">
                                            <img class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                                 src="{{ asset('storage/' . $item['snack']['image']) }}"
                                                 alt="{{ $item['snack']['name'] }}" />
                                        </div>
                                        <div class="ml-5">
                                            <p class="text-lg font-bold text-white group-hover:text-amber-500 transition-colors">
                                                {{ $item['snack']['name'] }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide font-semibold">Snack / Drink</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm font-bold text-gray-300">
                                        Rp {{ number_format($item['snack']['price'], 0, ',', '.') }}
                                    </p>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center items-center bg-slate-950 rounded-xl border border-slate-700 w-max mx-auto shadow-inner">
                                        <button wire:click="decrementQuantity({{ $item['snack']['id'] }})"
                                                class="px-3 py-1.5 text-gray-400 hover:text-white hover:bg-slate-800 rounded-l-xl transition-colors focus:outline-none">
                                            <svg class="h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M20 12H4"></path></svg>
                                        </button>

                                        <span class="px-4 py-1.5 text-white font-bold text-sm border-x border-slate-800 min-w-[44px] text-center bg-slate-900">
                                            {{ $item['quantity'] }}
                                        </span>

                                        <button wire:click="incrementQuantity({{ $item['snack']['id'] }})"
                                                class="px-3 py-1.5 text-gray-400 hover:text-white hover:bg-slate-800 rounded-r-xl transition-colors focus:outline-none">
                                            <svg class="h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 4v16m8-8H4"></path></svg>
                                        </button>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <p class="text-base font-black text-amber-500">
                                        Rp {{ number_format($item['snack']['price'] * $item['quantity'], 0, ',', '.') }}
                                    </p>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <button wire:click="removeItem({{ $item['snack']['id'] }})"
                                            class="text-red-500 hover:text-red-400 font-bold text-sm transition-colors flex items-center justify-end ml-auto gap-1.5 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end">
            <div class="w-full max-w-md bg-slate-900/50 backdrop-blur-xl shadow-2xl shadow-black/50 rounded-2xl border border-slate-800 p-8">
                <div class="flex justify-between items-center mb-8 border-b border-slate-800 pb-6">
                    <span class="text-lg font-bold text-gray-300 uppercase tracking-wide">Total Amount</span>
                    <span class="text-3xl font-black text-amber-500 drop-shadow-sm">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>
                <a href="{{ route('user.snacks.checkout') }}" class="w-full py-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-900 font-bold text-lg rounded-xl shadow-lg shadow-amber-500/20 transition-all transform hover:scale-[1.02] active:scale-[0.98] flex justify-center items-center gap-2">
                    Proceed to Checkout
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        </div>

    @else
        <div class="text-center py-20 px-6 border-2 border-dashed border-slate-800 rounded-2xl bg-slate-900/30">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-slate-800 mb-6 shadow-inner">
                <svg class="h-12 w-12 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">Your cart is empty</h3>
            <p class="text-gray-400 max-w-sm mx-auto mb-8 text-lg">Looks like you haven't added any delicious snacks yet. Get some popcorn for the movie!</p>

            <a href="{{ route('user.snacks.index') }}" class="inline-flex items-center px-8 py-3.5 border border-transparent text-base font-bold rounded-xl shadow-lg text-slate-900 bg-amber-500 hover:bg-amber-600 transition-all hover:scale-105">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Browse Snacks
            </a>
        </div>
    @endif
</div>
