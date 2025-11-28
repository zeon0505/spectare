<div>
    <div class="flex items-center mb-6">
        <h1 class="text-3xl font-bold text-amber-500">
            Create Studio
        </h1>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-md p-6">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                    <input type="text" id="name" wire:model="name"
                        class="shadow-sm appearance-none border border-slate-700 bg-slate-900 rounded-md w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-400 mb-2">Capacity</label>
                    <input type="number" id="capacity" wire:model="capacity"
                        class="shadow-sm appearance-none border border-slate-700 bg-slate-900 rounded-md w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                    @error('capacity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2 px-6 rounded-lg transition-colors shadow-md shadow-amber-500/30">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
