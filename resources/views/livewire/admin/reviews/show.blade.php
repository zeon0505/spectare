<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Detail Review</h2>

    <div class="mb-4">
        <p><strong>User:</strong> {{ $review->user->name }}</p>
        <p><strong>Film:</strong> {{ $review->film->title }}</p>
        <p><strong>Rating:</strong> {{ $review->rating }}⭐</p>
        <p><strong>Komentar:</strong> {{ $review->comment }}</p>
        <p><strong>Status:</strong>
            @if($review->is_approved)
                <span class="text-green-600 font-semibold">Disetujui</span>
            @else
                <span class="text-red-600 font-semibold">Menunggu</span>
            @endif
        </p>
    </div>

    @if(!$review->is_approved)
        <button wire:click="approve" class="bg-green-600 text-white px-4 py-2 rounded">Setujui Review</button>
    @endif
</div>
