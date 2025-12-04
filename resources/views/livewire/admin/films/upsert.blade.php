<div class="w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-3xl font-bold text-white mb-4 sm:mb-0">
            {{ $film->exists ? 'Edit Film' : 'Tambah Film Baru' }}
        </h1>

        <a href="{{ route('admin.films.index') }}"
            class="text-gray-400 hover:text-white font-semibold text-sm transition-colors">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <div class="bg-slate-800 rounded-xl shadow-2xl border border-slate-700 p-6">

        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">

                <div class="col-span-1 md:col-span-2">
                    <label for="title" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Judul Film</label>
                    <input type="text" id="title" wire:model="title"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                        placeholder="Masukan judul film...">
                    @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="selectedGenres" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Genre</label>
                    <div x-data="{ open: false, selectedGenres: @entangle('selectedGenres').live }" @keydown.escape.window="open = false" class="relative">
                        <button type="button" @click="open = !open"
                            class="relative w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 text-left focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                            <span class="block truncate text-sm">
                                <span x-show="selectedGenres.length == 0" class="text-gray-500">Pilih Genre</span>
                                <span x-show="selectedGenres.length > 0"
                                    x-text="selectedGenres.length + ' genre dipilih'"></span>
                            </span>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 3a.75.75 0 01.53.22l3.5 3.5a.75.75 0 01-1.06 1.06L10 4.81 7.03 7.78a.75.75 0 01-1.06-1.06l3.5-3.5A.75.75 0 0110 3zm-3.78 9.53a.75.75 0 011.06 0L10 15.19l2.97-2.97a.75.75 0 111.06 1.06l-3.5 3.5a.75.75 0 01-1.06 0l-3.5-3.5a.75.75 0 010-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute z-10 mt-1 w-full bg-slate-800 shadow-xl max-h-60 rounded-lg py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm border border-slate-600"
                            style="display: none;">
                            @foreach($genres as $genre)
                            <label
                                class="text-gray-300 relative cursor-pointer select-none py-2 pl-3 pr-9 hover:bg-slate-700 flex items-center transition-colors">
                                <input type="checkbox" value="{{ $genre->id }}" x-model="selectedGenres"
                                    class="h-4 w-4 rounded border-gray-500 bg-slate-900 text-amber-500 focus:ring-amber-500 transition-all">
                                <span class="ml-3 block truncate text-sm">{{ $genre->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @error('selectedGenres') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="release_date" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tanggal Rilis</label>
                    <input type="date" id="release_date" wire:model="release_date"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                    @error('release_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="duration" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Durasi (menit)</label>
                    <input type="number" id="duration" wire:model="duration"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                        placeholder="Contoh: 120">
                    @error('duration') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="age_rating" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Rating Usia</label>
                    <input type="text" id="age_rating" wire:model="age_rating"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                        placeholder="Contoh: R13+, D17+">
                    @error('age_rating') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="status" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Status</label>
                    <select id="status" wire:model="status"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                        <option value="Coming Soon">Coming Soon</option>
                        <option value="Now Playing">Now Playing</option>
                        <option value="Finished">Finished</option>
                    </select>
                    @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="trailer_url" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">URL Trailer</label>
                    <input type="url" id="trailer_url" wire:model="trailer_url"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                        placeholder="https://youtube.com/...">
                    @error('trailer_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                 <div class="col-span-1 md:col-span-2">
                    <label for="ticket_price" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Harga Tiket</label>
                    <input type="number" id="ticket_price" wire:model="ticket_price"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                        placeholder="Contoh: 50000" step="1000">
                    @error('ticket_price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="poster" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Poster</label>
                    <input type="file" id="poster" wire:model="poster"
                        class="block w-full text-sm text-gray-400
                               border border-slate-600 rounded-lg cursor-pointer
                               bg-slate-900 focus:outline-none
                               file:mr-4 file:py-2.5 file:px-4
                               file:rounded-l-lg file:border-0
                               file:text-xs file:font-bold file:uppercase file:tracking-wider
                               file:bg-slate-700 file:text-amber-500
                               hover:file:bg-slate-600 transition-all">

                    <div wire:loading wire:target="poster" class="mt-2 text-amber-500 text-xs">Uploading...</div>

                    @if ($poster)
                        <div class="mt-4">
                            <p class="text-xs text-gray-500 mb-1">Preview:</p>
                            <img src="{{ $poster->temporaryUrl() }}" class="w-24 h-auto rounded shadow-lg object-cover border border-slate-700">
                        </div>
                    @elseif ($film && $film->poster_url)
                        <div class="mt-4">
                            <p class="text-xs text-gray-500 mb-1">Poster Saat Ini:</p>
                            <img src="{{ asset('storage/' . $film->poster_url) }}" alt="Current Poster" class="w-24 h-auto rounded shadow-lg object-cover border border-slate-700">
                        </div>
                    @endif
                    @error('poster') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="description" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Deskripsi</label>
                    <textarea id="description" wire:model="description"
                        class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600 transition-all"
                        rows="4" placeholder="Sinopsis film..."></textarea>
                    @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

            </div>

            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-slate-700">
                <a href="{{ route('admin.films.index') }}"
                   class="text-gray-400 hover:text-white font-bold text-sm transition-colors px-4 py-2">
                    Batal
                </a>
                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>
