<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-4 sm:mb-0 drop-shadow-md">
            Cinema Studios
        </h1>

        <a href="{{ route('admin.studios.create') }}"
            class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-lg transition-all shadow-lg shadow-amber-500/20 hover:scale-105">
            + Add Studio
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 px-5 py-4 rounded-lg relative mb-8 shadow-md flex items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">

            <div class="md:col-span-3">
                <label for="search" class="block text-sm font-bold text-gray-400 mb-2">Search Studio</label>
                <input id="search" type="text" wire:model.live.debounce.300ms="search"
                    class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                    placeholder="Enter studio name...">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($studios as $studio)
            <div class="bg-slate-800 border border-slate-700 rounded-xl shadow-xl overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">

                <div class="relative h-48 w-full overflow-hidden">
                    <img src="{{ $studio->image ? asset('storage/' . $studio->image) : 'https://via.placeholder.com/400x225.png/0f172a/fbbf24?text=No+Image' }}"
                         alt="{{ $studio->name }}"
                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"/>

                    <div class="absolute top-3 right-3 bg-slate-900/80 backdrop-blur-sm text-amber-500 text-xs font-bold px-2 py-1 rounded border border-slate-600">
                        {{ $studio->capacity }} Seats
                    </div>
                </div>

                <div class="p-5">
                    <h2 class="text-xl font-bold text-white mb-3 group-hover:text-amber-500 transition-colors">{{ $studio->name }}</h2>

                    <div class="flex items-center space-x-2 text-sm text-gray-400 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-500" viewBox="0 0 20 20" fill="currentColor"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zM10 11a6 6 0 01-6-6 1 1 0 112 0 4 4 0 108 0 1 1 0 112 0 6 6 0 01-6 6z" /><path d="M10 12a7 7 0 00-7 7 1 1 0 002 0 5 5 0 0110 0 1 1 0 102 0 7 7 0 00-7-7z" /></svg>
                        <span>{{ $studio->capacity }} Capacity</span>
                    </div>

                    <div class="flex justify-end items-center space-x-3 pt-4 border-t border-slate-700">
                        <a href="{{ route('admin.studios.edit', $studio) }}"
                           class="text-sm font-semibold text-amber-500 hover:text-white transition-colors px-3 py-1.5 rounded hover:bg-slate-700">
                           Edit
                        </a>
                        <button wire:click="delete({{ $studio->id }})"
                            wire:confirm="Are you sure you want to delete this studio?"
                            class="text-sm font-semibold text-red-500 hover:text-red-400 transition-colors px-3 py-1.5 rounded hover:bg-slate-700">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-slate-800 rounded-xl border border-slate-700 shadow-inner">
                <div class="flex flex-col items-center justify-center">
                    <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <p class="text-gray-400 text-lg font-medium">No studios found matching your criteria.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $studios->links() }}
    </div>
</div>
