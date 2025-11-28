<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h1 class="text-3xl font-bold text-amber-500 mb-4 sm:mb-0">
            Edit Studio
        </h1>
        <a href="{{ route('admin.studios.index') }}"
            class="border border-slate-700 text-gray-300 hover:bg-slate-700 font-bold py-2 px-4 rounded-lg text-sm transition-all">
            Kembali ke Daftar Studio
        </a>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-md p-6 md:p-8">
        <form wire:submit.prevent="update">
            <div class="grid grid-cols-1 gap-6">

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                    <input type="text" id="name" wire:model="name"
                        class="shadow-sm appearance-none border border-slate-700 bg-slate-900 rounded-md w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder:text-gray-500"
                        placeholder="e.g., Studio 1">
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-400 mb-2">Capacity</label>
                    <input type="number" id="capacity" wire:model="capacity"
                        class="shadow-sm appearance-none border border-slate-700 bg-slate-900 rounded-md w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder:text-gray-500"
                        placeholder="e.g., 150">
                    @error('capacity') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-8 pt-6 border-t border-slate-700">
                <a href="{{ route('admin.studios.index') }}" class="text-gray-400 hover:text-gray-200 mr-4">
                    Batal
                </a>
                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2 px-6 rounded-lg transition-colors shadow-md shadow-amber-500/30">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
