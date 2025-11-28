<?php

namespace App\Livewire\User\Films;

use App\Models\Film;
use App\Models\Showtime;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;

class Show extends Component
{
    public Film $film;
    public $upcomingShowtimes;
    public $selectedShowtime;
    public $seats = [];
    public $selectedSeats = [];
    public $totalPrice = 0;
    public $reviews;
    public $isInWishlist;

    public function mount(Film $film)
    {
        $this->film = $film->load('genres');
        $this->loadUpcomingShowtimes();
        $this->loadReviews();
        $this->checkIfInWishlist();
    }

    public function checkIfInWishlist()
    {
        if (Auth::check()) {
            $this->isInWishlist = Wishlist::where('user_id', Auth::id())
                                          ->where('film_id', $this->film->id)
                                          ->exists();
        } else {
            $this->isInWishlist = false;
        }
    }

    public function toggleWishlist()
    {
        if (!Auth::check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        $wishlist = Wishlist::where('user_id', Auth::id())
                            ->where('film_id', $this->film->id)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $this->isInWishlist = false;
            session()->flash('message', 'Film telah dihapus dari wishlist.');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'film_id' => $this->film->id,
            ]);
            $this->isInWishlist = true;
            session()->flash('message', 'Film telah ditambahkan ke wishlist.');
        }
    }

    public function loadUpcomingShowtimes()
    {
        $this->upcomingShowtimes = $this->film->showtimes()
            ->where('date', '>=', now()->format('Y-m-d'))
            ->orderBy('date')
            ->orderBy('time')
            ->get();
    }

    public function loadReviews()
    {
        $this->reviews = $this->film->reviews()->where('is_approved', true)->with('user')->latest()->get();
    }

    public function selectShowtime(string $showtimeId)
    {
        $this->selectedShowtime = Showtime::with('studio')->find($showtimeId);
        if ($this->selectedShowtime) {
            $this->generateSeats();
            $this->selectedSeats = [];
            $this->totalPrice = 0;
        }
    }

     public function generateSeats()
    {
        $this->seats = [];
        $layout = $this->selectedShowtime->studio->layout;

        if (!$layout) {
            return;
        }

        // Definitive Fix: Use a direct `whereHas` query to avoid intermediate collections.
        $bookedSeats = \App\Models\BookingSeat::whereHas('booking', function ($query) {
            $query->where('showtime_id', $this->selectedShowtime->id);
        })->pluck('seat_number')->toArray();

        foreach ($layout as $rowIndex => $row) {
            $rowSeats = [];
            for ($i = 0; $i < strlen($row); $i++) {
                $char = $row[$i];
                if ($char === 'S') {
                    $seatNumber = chr(65 + $rowIndex) . ($i + 1);
                    $rowSeats[] = [
                        'number' => $seatNumber,
                        'status' => in_array($seatNumber, $bookedSeats) ? 'booked' : 'available',
                    ];
                } else {
                    $rowSeats[] = ['number' => null, 'status' => 'space'];
                }
            }
            $this->seats[] = $rowSeats;
        }
    }

    public function toggleSeat($seatNumber)
    {
        if (($key = array_search($seatNumber, $this->selectedSeats)) !== false) {
            unset($this->selectedSeats[$key]);
        } else {
            $this->selectedSeats[] = $seatNumber;
        }
        $this->calculateTotalPrice();
    }

    public function calculateTotalPrice()
    {
        if ($this->selectedShowtime) {
            $this->totalPrice = count($this->selectedSeats) * $this->selectedShowtime->film->ticket_price;
        }
    }

    public function proceedToBooking()
    {
        if (count($this->selectedSeats) > 0 && $this->selectedShowtime) {
            // Simpan detail booking ke session
            session([
                'booking_details' => [
                    'showtime_id' => $this->selectedShowtime->id,
                    'seats' => $this->selectedSeats,
                    'total_price' => $this->totalPrice,
                ],
            ]);

            // Redirect dengan parameter yang benar (mengirim seluruh objek showtime)
            return redirect()->route('user.bookings.create', ['showtime' => $this->selectedShowtime]);
        } else {
            // Beri pesan jika belum ada kursi yang dipilih
            session()->flash('error', 'Silakan pilih kursi terlebih dahulu.');
        }
    }

    public function render()
    {
        return view('livewire.user.films.show');
    }
}