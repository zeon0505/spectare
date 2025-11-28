<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-4 sm:mb-0 drop-shadow-md">
            Genres
        </h1>

        <a href="{{ route('admin.genres.create') }}"
            class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-lg transition-all shadow-lg shadow-amber-500/20 hover:scale-105">
            + Add Genre
        </a>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 px-5 py-4 rounded-lg relative mb-8 shadow-md" role="alert">
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-700">
                <thead class="bg-slate-900">
                    <tr>
                        <th scope="col"
                            class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase w-3/4">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($genres as $genre)
                        <tr wire:key="{{ $genre->id }}" class="hover:bg-slate-700/30 transition-colors duration-200">

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-100">{{ $genre->name }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-4">
                                    <a href="{{ route('admin.genres.edit', $genre) }}"
                                        class="text-amber-500 hover:text-white transition-colors font-semibold">
                                        Edit
                                    </a>
                                    <button wire:click="delete({{ $genre->id }})"
                                        wire:confirm="Are you sure you want to delete this genre?"
                                        class="text-red-500 hover:text-red-400 transition-colors font-semibold">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    <p class="text-gray-400 text-lg font-medium">No genres have been added yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $genres->links() }}
    </div>
</div>
