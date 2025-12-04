<div>
    <div class="flex items-center mb-6">
        <h1 class="text-3xl font-bold text-amber-500 drop-shadow-md">
            Create Genre
        </h1>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-2xl border border-slate-700 p-6 max-w-2xl">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Name</label>
                    <input type="text" id="name" wire:model="name"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                        placeholder="Enter genre name...">
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-slate-700">
                <a href="{{ route('admin.genres.index') }}"
                   class="text-gray-400 hover:text-white font-bold text-sm transition-colors px-4 py-2">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
