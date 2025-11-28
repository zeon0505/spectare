<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-2 drop-shadow-md">Our Snacks</h1>
        <p class="text-gray-400 text-sm">Delicious treats to enjoy while watching your favorite movies.</p>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 px-5 py-4 rounded-lg relative mb-8 shadow-md" role="alert">
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($snacks as $snack)
            <div class="bg-slate-800 border border-slate-700 rounded-xl shadow-xl overflow-hidden group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">

                <div class="relative h-48 w-full overflow-hidden bg-slate-900">
                    <img src="{{ asset('storage/' . $snack->image) }}"
                         alt="{{ $snack->name }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-white mb-1 truncate" title="{{ $snack->name }}">
                        {{ $snack->name }}
                    </h3>

                    <p class="text-sm text-gray-400 line-clamp-2 mb-4 flex-grow">
                        {{ $snack->description }}
                    </p>

                    <div class="pt-4 border-t border-slate-700 flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-amber-500">
                            Rp {{ number_format($snack->price, 0, ',', '.') }}
                        </span>

                        <button wire:click="addToCart({{ $snack->id }})"
                                class="bg-amber-500 hover:bg-amber-600 text-slate-900 text-sm font-bold py-2 px-4 rounded-lg shadow-lg shadow-amber-500/20 transition-all transform active:scale-95 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $snacks->links() }}
    </div>
</div>
