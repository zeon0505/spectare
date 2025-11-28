<?php

namespace App\Mail;

use App\Models\Film;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WishlistNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $film;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(Film $film, User $user)
    {
        $this->film = $film;
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Film yang Anda tunggu kini tersedia!')
                    ->view('emails.wishlist_notification')
                    ->with([
                        'film' => $this->film,
                        'user' => $this->user,
                    ]);
    }
}
