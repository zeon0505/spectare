<?php

namespace App\Jobs;

use App\Mail\WishlistNotificationMail;
use App\Models\Film;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWishlistNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $filmId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $userId, int $filmId)
    {
        $this->userId = $userId;
        $this->filmId = $filmId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $user = User::find($this->userId);
        $film = Film::find($this->filmId);

        if ($user && $film) {
            Mail::to($user->email)->send(new WishlistNotificationMail($film, $user));
        }
    }
}
