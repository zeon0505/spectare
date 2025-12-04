<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-300 drop-shadow-sm mb-2">
                Snacks Management
            </h1>
            <p class="text-gray-400 text-sm">Manage your cinema's food and beverage offerings.</p>
        </div>

        <a href="{{ route('admin.snacks.create') }}"
            class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-xl transition-all shadow-lg shadow-amber-500/20 hover:scale-105 flex items-center gap-2 mt-4 sm:mt-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Snack
        </a>
    </div>

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             class="mb-6 bg-green-500/10 border-l-4 border-green-500 text-green-400 px-6 py-4 rounded-r-lg shadow-lg flex items-center gap-3 animate-fade-in-up">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-800">
                <thead class="bg-slate-950/50">
                    <tr>
                        <th scope="col" class="px-6 py-5 text-xs font-bold tracking-wider text-left text-gray-400 uppercase w-24">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-5 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-5 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-5 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-5 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-800">
                    @foreach ($snacks as $snack)
                        <tr wire:key="{{ $snack->id }}" class="hover:bg-slate-800/50 transition-colors duration-200 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex-shrink-0 w-16 h-16 shadow-lg rounded-lg overflow-hidden border border-slate-700 group-hover:border-amber-500/50 transition-colors">
                                    <img src="{{ asset('storage/' . $snack->image) }}" alt="{{ $snack->name }}"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-white group-hover:text-amber-500 transition-colors">{{ $snack->name }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wide bg-slate-800 text-gray-300 border border-slate-700">
                                    {{ $snack->type }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-amber-500">
                                    Rp {{ number_format($snack->price, 0, ',', '.') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.snacks.edit', ['snack' => $snack->id]) }}"
                                        class="p-2 bg-slate-800 text-amber-500 rounded-lg hover:bg-amber-500 hover:text-slate-900 transition-all shadow-lg hover:shadow-amber-500/50"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <button wire:click="delete({{ $snack->id }})"
                                        wire:confirm="Are you sure you want to delete this snack?"
                                        class="p-2 bg-slate-800 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-lg hover:shadow-red-500/50"
                                        title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(method_exists($snacks, 'links'))
            <div class="px-6 py-4 border-t border-slate-800 bg-slate-900/50">
                {{ $snacks->links() }}
            </div>
        @endif
    </div>
</div>
