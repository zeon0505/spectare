<div>
    <div class="flex items-center mb-6">
        <h1 class="text-3xl font-bold text-amber-500">
            Create Showtime
        </h1>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-2xl border border-slate-700 p-6 max-w-4xl">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="film_id" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Film</label>
                    <select id="film_id" wire:model="film_id"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                        <option value="">Select a film</option>
                        @foreach ($films as $film)
                            <option value="{{ $film->id }}">{{ $film->title }}</option>
                        @endforeach
                    </select>
                    @error('film_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="studio_id" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Studio</label>
                    <select id="studio_id" wire:model="studio_id"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                        <option value="">Select a studio</option>
                        @foreach ($studios as $studio)
                            <option value="{{ $studio->id }}">{{ $studio->name }}</option>
                        @endforeach
                    </select>
                    @error('studio_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="start_date" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Start Date</label>
                    <input type="date" id="start_date" wire:model="start_date"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                    @error('start_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">End Date</label>
                    <input type="date" id="end_date" wire:model="end_date"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                    @error('end_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="time" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Time</label>
                    <input type="time" id="time" wire:model="time"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                    @error('time') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-slate-700">
                <a href="{{ route('admin.showtimes.index') }}"
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
