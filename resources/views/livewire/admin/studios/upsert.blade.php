<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-4 sm:mb-0 drop-shadow-md">
            {{ $studio?->id ? 'Edit Studio' : 'Add Studio' }}
        </h1>

        <a href="{{ route('admin.studios.index') }}"
           class="text-gray-400 hover:text-white font-semibold text-sm transition-colors">
            &larr; Back to Studios
        </a>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-2xl border border-slate-700 p-6 max-w-4xl">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label for="name" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Name</label>
                    <input type="text" id="name" wire:model="name"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                        placeholder="e.g., Studio 1">
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="location" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Location</label>
                    <input type="text" id="location" wire:model="location"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                        placeholder="e.g., Jakarta / 1st Floor">
                    @error('location') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="capacity" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Capacity</label>
                    <input type="number" id="capacity" wire:model="capacity"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                        placeholder="e.g., 150">
                    @error('capacity') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="image" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Studio Image</label>
                    <input type="file" id="image" wire:model="image"
                        class="block w-full text-sm text-gray-400
                               border border-slate-600 rounded-lg cursor-pointer
                               bg-slate-900 focus:outline-none
                               file:mr-4 file:py-2.5 file:px-4
                               file:rounded-l-lg file:border-0
                               file:text-xs file:font-bold file:uppercase file:tracking-wider
                               file:bg-slate-700 file:text-amber-500
                               hover:file:bg-slate-600 transition-all">

                    <div wire:loading wire:target="image" class="mt-2 text-amber-500 text-xs">Uploading...</div>

                    @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                    @if ($image)
                        <div class="mt-4">
                            <p class="text-xs text-gray-400 mb-1 font-bold uppercase tracking-wider">New Image Preview:</p>
                            <img src="{{ $image->temporaryUrl() }}" class="w-64 h-auto rounded-lg shadow-lg border border-slate-600 object-cover">
                        </div>
                    @elseif ($existingImage)
                        <div class="mt-4">
                            <p class="text-xs text-gray-400 mb-1 font-bold uppercase tracking-wider">Current Image:</p>
                            <img src="{{ asset('storage/' . $existingImage) }}" class="w-64 h-auto rounded-lg shadow-lg border border-slate-600 object-cover opacity-80">
                        </div>
                    @endif
                </div>

            </div>

            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-slate-700">
                <a href="{{ route('admin.studios.index') }}"
                    class="text-gray-400 hover:text-white font-bold text-sm transition-colors px-4 py-2">
                    Cancel
                </a>

                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
