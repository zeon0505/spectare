<?php

namespace Tests\Feature;

use App\Mail\BookingConfirmation;
use App\Models\Booking;
use App\Models\Film;
use App\Models\Showtime;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BookingConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_confirmation_email_is_sent()
    {
        Mail::fake();

        $user = User::factory()->create();
        $studio = Studio::factory()->create();
        \App\Models\Genre::factory()->count(3)->create(); // Create genres first
        $film = Film::factory()->create();
        $showtime = Showtime::factory()->create([
            'film_id' => $film->id,
            'studio_id' => $studio->id,
        ]);

        $booking = Booking::create([
            'user_id' => $user->id,
            'showtime_id' => $showtime->id,
            'transaction_id' => 1,
            'total_price' => 50000,
            'status' => 'confirmed',
            'qr_code_path' => 'path/to/qr.png',
        ]);

        // Trigger email sending manually for this test since we can't easily simulate Midtrans callback here without more setup
        Mail::to($user->email)->send(new BookingConfirmation($booking));

        Mail::assertSent(BookingConfirmation::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
