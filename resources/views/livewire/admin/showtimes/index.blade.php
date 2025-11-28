<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-4 sm:mb-0 drop-shadow-md">
            Showtimes
        </h1>

        <a href="{{ route('admin.showtimes.create') }}"
            class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-lg transition-all shadow-lg shadow-amber-500/20 hover:scale-105">
            + Add Showtime
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
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase w-1/4">
                            Film
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Studio
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Time
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-700">
                    @forelse ($showtimes as $showtime)
                        <tr wire:key="{{ $showtime->id }}" class="hover:bg-slate-700/30 transition-colors duration-200">

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-16 w-12 shadow-md rounded overflow-hidden border border-slate-600">
                                        <img class="h-full w-full object-cover"
                                             src="{{ Str::startsWith($showtime->film->poster_url, 'http') ? $showtime->film->poster_url : Storage::url($showtime->film->poster_url) }}"
                                             alt="{{ $showtime->film->title }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-white">{{ $showtime->film->title }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ $showtime->studio->name }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ $showtime->date->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-700 text-amber-500 border border-slate-600">
                                    {{ $showtime->time->format('H:i') }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-4">
                                    <a href="{{ route('admin.showtimes.edit', $showtime) }}"
                                        class="text-amber-500 hover:text-white transition-colors font-semibold">
                                        Edit
                                    </a>
                                    <button wire:click="delete({{ $showtime->id }})"
                                        wire:confirm="Are you sure you want to delete this showtime?"
                                        class="text-red-500 hover:text-red-400 transition-colors font-semibold">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-gray-400 text-lg font-medium">No showtimes have been added yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $showtimes->links() }}
    </div>
</div>
