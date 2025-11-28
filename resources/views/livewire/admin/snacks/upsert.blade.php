<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-4 sm:mb-0 drop-shadow-md">
            {{ $snack->exists ? 'Edit Snack' : 'Create Snack' }}
        </h1>

        <a href="{{ route('admin.snacks.index') }}"
           class="text-gray-400 hover:text-white font-semibold text-sm transition-colors">
            &larr; Back to Snacks
        </a>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-8">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 gap-6">

                <div>
                    <label for="name" class="block text-sm font-bold text-gray-300 mb-2">Name</label>
                    <input type="text" id="name" wire:model="name"
                        class="w-full bg-slate-700 text-white border border-slate-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-500 transition-all"
                        placeholder="e.g., Popcorn Caramel">
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-bold text-gray-300 mb-2">Type</label>
                    <input type="text" id="type" wire:model="type"
                        class="w-full bg-slate-700 text-white border border-slate-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-500 transition-all"
                        placeholder="e.g., Food / Drink">
                    @error('type') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-bold text-gray-300 mb-2">Price</label>
                    <input type="number" id="price" wire:model="price"
                        class="w-full bg-slate-700 text-white border border-slate-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-500 transition-all"
                        placeholder="e.g., 50000">
                    @error('price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="image" class="block text-sm font-bold text-gray-300 mb-2">Image</label>
                    <input type="file" id="image" wire:model="newImage"
                        class="block w-full text-sm text-gray-400
                               border border-slate-600 rounded-lg cursor-pointer
                               bg-slate-700 focus:outline-none
                               file:mr-4 file:py-3 file:px-6
                               file:rounded-l-lg file:border-0
                               file:text-sm file:font-bold
                               file:bg-amber-500 file:text-slate-900
                               hover:file:bg-amber-600 transition-all">

                    <div wire:loading wire:target="newImage" class="mt-2 text-amber-500 text-sm">Uploading...</div>

                    @error('newImage') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                    @if ($newImage)
                        <div class="mt-4">
                            <p class="text-xs text-gray-400 mb-1 font-bold uppercase tracking-wider">New Image Preview:</p>
                            <img src="{{ $newImage->temporaryUrl() }}" class="w-32 h-32 object-cover rounded-lg shadow-lg border border-slate-600">
                        </div>
                    @elseif ($image)
                        <div class="mt-4">
                            <p class="text-xs text-gray-400 mb-1 font-bold uppercase tracking-wider">Current Image:</p>
                            <img src="{{ asset('storage/' . $image) }}" class="w-32 h-32 object-cover rounded-lg shadow-lg border border-slate-600 opacity-80">
                        </div>
                    @endif
                </div>

            </div>

            <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-700">

                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-3 px-8 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Save
                </button>

                <a href="{{ route('admin.snacks.index') }}"
                    class="text-gray-400 hover:text-white font-bold text-sm transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
