<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-300 drop-shadow-sm mb-2">
                {{ $snack->exists ? 'Edit Snack' : 'Create Snack' }}
            </h1>
            <p class="text-gray-400 text-sm">
                {{ $snack->exists ? 'Update the details of your snack.' : 'Add a new snack to your menu.' }}
            </p>
        </div>

        <a href="{{ route('admin.snacks.index') }}"
           class="group flex items-center text-gray-400 hover:text-white font-semibold text-sm transition-colors mt-4 sm:mt-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Snacks
        </a>
    </div>

    <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 p-8">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 gap-8">

                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Name</label>
                    <input type="text" id="name" wire:model="name"
                        class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 placeholder-gray-600 transition-all shadow-inner"
                        placeholder="e.g., Popcorn Caramel">
                    @error('name') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Type</label>
                        <select id="type" wire:model="type"
                            class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all shadow-inner appearance-none">
                            <option value="">Select Type</option>
                            <option value="Food">Food</option>
                            <option value="Drink">Drink</option>
                            <option value="Combo">Combo</option>
                        </select>
                        @error('type') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Price (Rp)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" id="price" wire:model="price"
                                class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 pl-10 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 placeholder-gray-600 transition-all shadow-inner"
                                placeholder="50000">
                        </div>
                        @error('price') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Image</label>
                    
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-700 border-dashed rounded-xl hover:border-amber-500/50 transition-colors bg-slate-800/30">
                        <div class="space-y-1 text-center">
                            @if ($newImage)
                                <img src="{{ $newImage->temporaryUrl() }}" class="mx-auto h-48 w-auto rounded-lg shadow-lg object-cover mb-4">
                            @elseif ($image)
                                <img src="{{ asset('storage/' . $image) }}" class="mx-auto h-48 w-auto rounded-lg shadow-lg object-cover mb-4">
                            @else
                                <svg class="mx-auto h-12 w-12 text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            @endif
                            
                            <div class="flex text-sm text-gray-400 justify-center">
                                <label for="image-upload" class="relative cursor-pointer bg-slate-800 rounded-md font-medium text-amber-500 hover:text-amber-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-amber-500 focus-within:ring-offset-slate-900">
                                    <span class="px-2">Upload a file</span>
                                    <input id="image-upload" wire:model="newImage" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                PNG, JPG, GIF up to 10MB
                            </p>
                        </div>
                    </div>
                    <div wire:loading wire:target="newImage" class="mt-2 text-amber-500 text-sm font-medium animate-pulse">Uploading image...</div>
                    @error('newImage') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                </div>

            </div>

            <div class="flex items-center justify-end mt-10 pt-6 border-t border-slate-800 gap-4">
                <a href="{{ route('admin.snacks.index') }}"
                    class="px-6 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-slate-800 font-bold text-sm transition-all">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-900 font-bold py-3 px-8 rounded-xl shadow-lg shadow-amber-500/20 transition-all transform hover:scale-105 active:scale-95">
                    {{ $snack->exists ? 'Update Snack' : 'Create Snack' }}
                </button>
            </div>
        </form>
    </div>
</div>
