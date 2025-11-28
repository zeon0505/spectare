<div>
    <div class="flex items-center mb-6">
        <h1 class="text-3xl font-bold text-amber-500">
            Edit Showtime
        </h1>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-md p-6">
        <form wire:submit.prevent="update">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="film_id" class="block text-sm font-medium text-gray-400 mb-2">Film</label>
                    <select id="film_id" wire:model="film_id"
                        class="shadow-sm appearance-none border border-slate-700 bg-slate-900 rounded-md w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                        <option value="">Select a film</option>
                        @foreach ($films as $film)
                            <option value="{{ $film->id }}">{{ $film->title }}</option>
                        @endforeach
                    </select>
                    @error('film_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="studio_id" class="block text-sm font-medium text-gray-400 mb-2">Studio</label>
                    <select id="studio_id" wire:model="studio_id"
                        class="shadow-sm appearance-none border border-slate-700 bg-slate-900 rounded-md w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                        <option value="">Select a studio</option>
                        @foreach ($studios as $studio)
                            <option value="{{ $studio->id }}">{{ $studio->name }}</option>
                        @endforeach
                    </select>
                    @error('studio_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-400 mb-2">Date</label>
                    <input type="date" id="date" wire:model="date"
                        class="shadow-sm appearance-none border border-slate-700 bg-slate-900 rounded-md w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                    @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="time" class="block text-sm font-medium text-gray-400 mb-2">Time</label>
                    <input type="time" id="time" wire:model="time"
                        class="shadow-sm appearance-none border border-slate-700 bg-slate-900 rounded-md w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                    @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <button type="button" wire:click="delete"
                    onclick="return confirm('Are you sure you want to delete this showtime?')"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-lg transition-colors shadow-md shadow-red-500/30">
                    Delete
                </button>
                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2 px-6 rounded-lg transition-colors shadow-md shadow-amber-500/30">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
