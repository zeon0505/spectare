<?php

namespace App\Livewire\User\Bookings;

use App\Models\Booking;
use App\Models\Showtime;
use Livewire\Component;

class SeatSelection extends Component
{
    public ?Showtime $showtime = null;
    public $seats = [];
    public $selectedSeats = [];
    public $totalPrice = 0;

    public function mount()
    {
        $showtimeId = request()->query('showtime');
        if ($showtimeId) {
            $this->showtime = Showtime::findOrFail($showtimeId);
            $this->showtime->load('film', 'studio', 'bookings.seats');
            $this->generateSeats();
        }
    }

    private function generateSeats()
    {
        $this->seats = [];
        if ($this->showtime->studio) {
            $layout = $this->showtime->studio->layout;
            $bookedSeats = $this->showtime->bookings->flatMap(function ($booking) {
                return $booking->seats->pluck('seat_number');
            })->toArray();

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
        if ($this->showtime && $this->showtime->film) {
            $this->totalPrice = count($this->selectedSeats) * $this->showtime->film->ticket_price;
        }
    }

    public function proceedToBooking()
    {
        if (empty($this->selectedSeats)) {
            session()->flash('error', 'Please select at least one seat.');
            return;
        }

        session([
            'booking_details' => [
                'showtime_id' => $this->showtime->id,
                'seats' => $this->selectedSeats,
                'total_price' => $this->totalPrice,
            ]
        ]);

        return redirect()->route('user.bookings.create', [
            'showtime' => $this->showtime->id,
        ]);
    }

    public function render()
    {
        return view('livewire.user.bookings.seat-selection');
    }
}
