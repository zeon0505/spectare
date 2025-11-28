<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-amber-500 drop-shadow-md">
            Leave a Review
        </h1>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 px-5 py-4 rounded-lg relative mb-8 shadow-md" role="alert">
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-8">
        <form wire:submit.prevent="save">

            <div class="mb-6">
                <label for="rating" class="block text-sm font-bold text-gray-300 mb-2">Rating</label>
                <div class="flex items-center space-x-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg wire:click="$set('rating', {{ $i }})"
                             class="w-8 h-8 cursor-pointer transition-colors duration-200 {{ $rating >= $i ? 'text-amber-500 drop-shadow-[0_0_5px_rgba(245,158,11,0.8)]' : 'text-slate-600 hover:text-slate-500' }}"
                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.365 2.444a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.365-2.444a1 1 0 00-1.175 0l-3.365 2.444c-.784.57-1.838-.197-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.073 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                        </svg>
                    @endfor
                </div>
                @error('rating') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="comment" class="block text-sm font-bold text-gray-300 mb-2">Comment</label>
                <textarea wire:model.defer="comment" id="comment" rows="4"
                    class="w-full bg-slate-700 text-white border border-slate-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-500 transition-all"
                    placeholder="Write your experience here..."></textarea>
                @error('comment') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end border-t border-slate-700 pt-6">
                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-3 px-8 rounded-lg shadow-lg transition-transform transform hover:scale-105 shadow-amber-500/20">
                    Submit Review
                </button>
            </div>
        </form>
    </div>
</div>
