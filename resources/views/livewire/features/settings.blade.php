<main class="flex-1 overflow-y-auto p-6 lg:p-8">
    <div class="bg-slate-800/50 border border-slate-700 rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b border-slate-700">
            <h1 class="text-2xl font-bold text-amber-400">My Profile</h1>
            <p class="mt-2 text-gray-400">Update your account's profile information.</p>
        </div>

        <div class="p-6">
            <form wire:submit.prevent="save">
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                        <input type="text" id="name" wire:model="name"
                            class="mt-1 block w-full bg-slate-700/50 border border-slate-600 rounded-md shadow-sm text-gray-200 focus:border-amber-500 focus:ring focus:ring-amber-500 focus:ring-opacity-50">
                        @error('name')
                            <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                        <input type="email" id="email" wire:model="email"
                            class="mt-1 block w-full bg-slate-700/50 border border-slate-600 rounded-md shadow-sm text-gray-200 focus:border-amber-500 focus:ring focus:ring-amber-500 focus:ring-opacity-50">
                        @error('email')
                            <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-slate-900 uppercase tracking-widest hover:bg-amber-400 active:bg-amber-600 focus:outline-none focus:border-amber-700 focus:ring ring-amber-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
