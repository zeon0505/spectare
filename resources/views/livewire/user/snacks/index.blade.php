<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="mb-10 text-center sm:text-left">
        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-300 drop-shadow-sm mb-3">
            Our Snacks
        </h1>
        <p class="text-gray-400 text-lg max-w-2xl">
            Complete your movie experience with our delicious selection of snacks and beverages.
        </p>
    </div>

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             class="mb-8 bg-green-500/10 border-l-4 border-green-500 text-green-400 px-6 py-4 rounded-r-lg shadow-lg flex items-center gap-3 animate-fade-in-up">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($snacks as $snack)
            <div class="group bg-slate-900/50 backdrop-blur-sm border border-slate-800 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl hover:shadow-amber-500/10 hover:-translate-y-2 transition-all duration-300 flex flex-col h-full relative">
                
                <!-- Image Container -->
                <div class="relative h-56 w-full overflow-hidden bg-slate-950">
                    <img src="{{ asset('storage/' . $snack->image) }}"
                         alt="{{ $snack->name }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-80"></div>
                    
                    <!-- Type Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="px-3 py-1 bg-slate-900/80 backdrop-blur-md text-amber-500 text-xs font-bold uppercase tracking-wider rounded-full border border-slate-700 shadow-lg">
                            {{ $snack->type }}
                        </span>
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-grow relative">
                    <h3 class="text-xl font-bold text-white mb-2 truncate group-hover:text-amber-500 transition-colors" title="{{ $snack->name }}">
                        {{ $snack->name }}
                    </h3>

                    <p class="text-sm text-gray-400 line-clamp-2 mb-6 flex-grow leading-relaxed">
                        {{ $snack->description ?? 'A delicious treat to enjoy with your movie.' }}
                    </p>

                    <div class="pt-4 border-t border-slate-800 flex items-center justify-between mt-auto gap-4">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Price</span>
                            <span class="text-lg font-black text-amber-500">
                                Rp {{ number_format($snack->price, 0, ',', '.') }}
                            </span>
                        </div>

                        <button wire:click="addToCart({{ $snack->id }})"
                                class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-900 text-sm font-bold py-2.5 px-5 rounded-xl shadow-lg shadow-amber-500/20 transition-all transform active:scale-95 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-12">
        {{ $snacks->links() }}
    </div>
</div>
