<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-4 sm:mb-0 drop-shadow-md">
            Snacks Management
        </h1>

        <a href="{{ route('admin.snacks.create') }}"
            class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-lg transition-all shadow-lg shadow-amber-500/20 hover:scale-105">
            + Add Snack
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
                            Image
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-400 uppercase">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-700">
                    @foreach ($snacks as $snack)
                        <tr wire:key="{{ $snack->id }}" class="hover:bg-slate-700/30 transition-colors duration-200">

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex-shrink-0 w-16 h-16 shadow-md rounded-lg overflow-hidden border border-slate-600">
                                    <img src="{{ asset('storage/' . $snack->image) }}" alt="{{ $snack->name }}"
                                        class="w-full h-full object-cover">
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-white">{{ $snack->name }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-700 text-gray-300 border border-slate-600">
                                    {{ $snack->type }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-amber-500">
                                    Rp {{ number_format($snack->price, 0, ',', '.') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-4">
                                    <a href="{{ route('admin.snacks.edit', ['snack' => $snack->id]) }}"
                                        class="text-amber-500 hover:text-white transition-colors font-semibold">
                                        Edit
                                    </a>
                                    <button wire:click="delete({{ $snack->id }})"
                                        wire:confirm="Are you sure you want to delete this snack?"
                                        class="text-red-500 hover:text-red-400 transition-colors font-semibold">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(method_exists($snacks, 'links'))
            <div class="px-6 py-4 border-t border-slate-700 bg-slate-800">
                {{ $snacks->links() }}
            </div>
        @endif
    </div>
</div>
