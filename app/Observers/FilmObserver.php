<?php

namespace App\Observers;

use App\Models\Film;
use App\Models\Wishlist;
use App\Jobs\SendWishlistNotificationJob;

class FilmObserver
{
    /**
     * Handle the Film "updated" event.
     */
    public function updated(Film $film)
    {
        // Check if the status column was changed
        if ($film->isDirty('status')) {
            $newStatus = $film->status;
            if (in_array($newStatus, ['Now Showing', 'Coming Soon'])) {
                // Get distinct user IDs who have this film in their wishlist
                $userIds = Wishlist::where('film_id', $film->id)
                    ->pluck('user_id')
                    ->unique();

                foreach ($userIds as $userId) {
                    SendWishlistNotificationJob::dispatch($userId, $film->id);
                }
            }
        }
    }
}
