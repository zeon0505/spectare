@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">
        <div class="p-6 border-b border-slate-700">
            <h1 class="text-2xl font-bold text-white">My Transactions</h1>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-300">
                <thead class="text-xs text-white uppercase bg-slate-700/50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Transaction ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Film
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date & Time
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Amount
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">View</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr class="border-b border-slate-700 hover:bg-slate-700/30 transition-colors duration-200">
                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                #{{ $transaction->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $transaction->booking->showtime->film->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 font-bold text-amber-500">
                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs px-2 py-1 rounded-full
                                    @if($transaction->status == 'paid') bg-green-500/20 text-green-400
                                    @elseif($transaction->status == 'pending') bg-yellow-500/20 text-yellow-400
                                    @else bg-red-500/20 text-red-400 @endif">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('user.transactions.detail', $transaction->id) }}" class="font-medium text-blue-500 hover:underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 px-6">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-semibold text-white">No transactions</h3>
                                    <p class="mt-1 text-sm text-gray-400">You don't have any transactions yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
            <div class="p-6 border-t border-slate-700">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
