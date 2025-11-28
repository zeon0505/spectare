<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-2 drop-shadow-md">Shopping Cart</h1>
        <p class="text-gray-400 text-sm">Review your selected snacks before checkout.</p>
    </div>

    @if(count($cartItems) > 0)
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-700">

                    <thead class="bg-slate-900">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase w-1/3">
                                Snack
                            </th>
                            <th class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                Price
                            </th>
                            <th class="px-6 py-4 text-xs font-bold tracking-wider text-center text-gray-400 uppercase">
                                Quantity
                            </th>
                            <th class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                                Total
                            </th>
                            <th class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-700">
                        @foreach ($cartItems as $item)
                            <tr class="hover:bg-slate-700/30 transition-colors duration-200">

                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-20 h-20 shadow-md rounded-lg overflow-hidden border border-slate-600">
                                            <img class="w-full h-full object-cover"
                                                 src="{{ asset('storage/' . $item['snack']['image']) }}"
                                                 alt="{{ $item['snack']['name'] }}" />
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-lg font-bold text-white">
                                                {{ $item['snack']['name'] }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">Snack / Drink</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm font-medium text-gray-300">
                                        Rp {{ number_format($item['snack']['price'], 0, ',', '.') }}
                                    </p>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center items-center bg-slate-900 rounded-lg border border-slate-600 w-max mx-auto">
                                        <button wire:click="decrementQuantity({{ $item['snack']['id'] }})"
                                                class="px-3 py-1 text-gray-400 hover:text-white hover:bg-slate-700 rounded-l-lg transition-colors focus:outline-none">
                                            <svg class="h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M20 12H4"></path></svg>
                                        </button>

                                        <span class="px-4 py-1 text-white font-bold text-sm border-x border-slate-700 min-w-[40px] text-center">
                                            {{ $item['quantity'] }}
                                        </span>

                                        <button wire:click="incrementQuantity({{ $item['snack']['id'] }})"
                                                class="px-3 py-1 text-gray-400 hover:text-white hover:bg-slate-700 rounded-r-lg transition-colors focus:outline-none">
                                            <svg class="h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 4v16m8-8H4"></path></svg>
                                        </button>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <p class="text-base font-bold text-amber-500">
                                        Rp {{ number_format($item['snack']['price'] * $item['quantity'], 0, ',', '.') }}
                                    </p>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <button wire:click="removeItem({{ $item['snack']['id'] }})"
                                            class="text-red-500 hover:text-red-400 font-medium text-sm transition-colors flex items-center justify-end ml-auto gap-1">
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
            <div class="w-full max-w-md bg-slate-800 shadow-2xl shadow-black/50 rounded-xl border border-slate-700 p-6">
                <div class="flex justify-between items-center mb-6 border-b border-slate-700 pb-4">
                    <span class="text-lg font-medium text-gray-300">Total Amount</span>
                    <span class="text-2xl font-bold text-amber-500">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>
                <a href="{{ route('user.snacks.checkout') }}" class="w-full py-3.5 bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold rounded-lg shadow-lg shadow-amber-500/20 transition-all transform hover:scale-[1.02] flex justify-center items-center gap-2">
                    Proceed to Checkout
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        </div>

    @else
        <div class="text-center py-16 px-6 border-2 border-dashed border-slate-700 rounded-xl bg-slate-800/50">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-800 mb-6 shadow-inner">
                <svg class="h-10 w-10 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Your cart is empty</h3>
            <p class="text-gray-400 max-w-sm mx-auto mb-8">Looks like you haven't added any delicious snacks yet. Get some popcorn for the movie!</p>

            <a href="{{ route('user.snacks.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-lg shadow-lg text-slate-900 bg-amber-500 hover:bg-amber-600 transition-all hover:scale-105">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Browse Snacks
            </a>
        </div>
    @endif
</div>
