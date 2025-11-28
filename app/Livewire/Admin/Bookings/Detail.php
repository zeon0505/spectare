<?php

namespace App\Livewire\Admin\Bookings;

use App\Models\Booking;
use Livewire\Component;
use App\Models\BookingSeat;

class Detail extends Component
{
    public Booking $booking;

    public array $seatsLayout = [];

    public bool $isEditingSeats = false;

    public array $selectedSeats = [];

    public array $originalSeatIds = [];

    public function mount(Booking $booking)
    {
        $this->booking = $booking->load('user', 'showtime.film', 'showtime.studio', 'seats', 'transaction');
        $this->generateSeatsLayout();
    }

    public function generateSeatsLayout()
    {
        $this->seatsLayout = [];
        $studio = $this->booking->showtime->studio;
        $layout = $studio->layout;
        if (!$layout) {
            return;
        }

        $bookedSeatsForShowtime = \App\Models\BookingSeat::whereHas('booking', function ($query) {
            $query->where('showtime_id', $this->booking->showtime_id);
        })->pluck('seat_number')->toArray();

        $thisBookingSeatNumbers = $this->booking->seats->pluck('seat_number')->toArray();

        foreach ($layout as $rowIndex => $row) {
            $rowSeats = [];
            for ($i = 0; $i < strlen($row); $i++) {
                $char = $row[$i];
                if ($char === 'S') {
                    $seatNumber = chr(65 + $rowIndex) . ($i + 1);
                    $status = 'available';
                    if (in_array($seatNumber, $bookedSeatsForShowtime)) {
                        $status = 'booked';
                    }
                    if (in_array($seatNumber, $thisBookingSeatNumbers)) {
                        $status = 'this_booking';
                    }

                    $rowSeats[] = [
                        'number' => $seatNumber,
                        'status' => $status,
                    ];
                } else {
                    $rowSeats[] = ['number' => null, 'status' => 'space'];
                }
            }
            $this->seatsLayout[] = $rowSeats;
        }
    }

    public function editSeats()
    {
        $this->isEditingSeats = true;
        $this->selectedSeats = $this->booking->seats->pluck('seat_number')->toArray();
        $this->originalSeatIds = $this->booking->seats->pluck('id')->toArray();
    }

    public function cancelEdit()
    {
        $this->isEditingSeats = false;
        $this->selectedSeats = [];
        $this->originalSeatIds = [];
    }

    public function toggleSeat($seatNumber)
    {
        if (!$this->isEditingSeats) {
            return;
        }

        if (in_array($seatNumber, $this->selectedSeats)) {
            $this->selectedSeats = array_diff($this->selectedSeats, [$seatNumber]);
        } else {
            $this->selectedSeats[] = $seatNumber;
        }
    }

    public function updateSeats()
    {
        if (!$this->isEditingSeats) {
            return;
        }

        // Validasi kursi yang dipilih, pastikan tidak ada yang sudah dibooking orang lain
        $otherBookedSeats = BookingSeat::whereHas('booking', function ($query) {
            $query->where('showtime_id', $this->booking->showtime_id)
                  ->where('id', '!=', $this->booking->id); // Kursi dari booking lain
        })->whereIn('seat_number', $this->selectedSeats)->pluck('seat_number')->toArray();

        if (!empty($otherBookedSeats)) {
            session()->flash('error', 'Gagal update. Kursi ' . implode(', ', $otherBookedSeats) . ' sudah dipesan orang lain.');
            return;
        }

        // Hapus kursi lama
        BookingSeat::whereIn('id', $this->originalSeatIds)->delete();

        // Buat data kursi baru
        $newSeats = [];
        foreach ($this->selectedSeats as $seatNumber) {
            $newSeats[] = [
                'booking_id' => $this->booking->id,
                'seat_number' => $seatNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (!empty($newSeats)) {
            BookingSeat::insert($newSeats);
        }

        // Hitung ulang total harga dengan benar
        $totalPrice = count($this->selectedSeats) * $this->booking->showtime->film->ticket_price;
        $this->booking->total_price = $totalPrice;
        $this->booking->save();

        // Update transaksi jika ada
        if ($this->booking->transaction) {
            $this->booking->transaction->update(['amount' => $totalPrice]);
        }

        // Refresh data booking dan keluar dari mode edit
        $this->booking->refresh();
        $this->isEditingSeats = false;
        $this->selectedSeats = [];
        $this->originalSeatIds = [];
        $this->generateSeatsLayout(); // Buat ulang layout dengan data kursi baru

        session()->flash('success', 'Seat booking berhasil diperbarui.');
    }

    public function confirmBooking()
    {
        if ($this->booking->status === 'pending') {
            $this->booking->status = 'paid';
            $this->booking->save();

            if ($this->booking->transaction) {
                $this->booking->transaction->status = 'success';
                $this->booking->transaction->save();
            }

            session()->flash('success', 'Booking has been confirmed successfully.');
        }
    }

    public function cancelBooking()
    {
        if ($this->booking->status !== 'cancelled') {
            $this->booking->status = 'cancelled';
            $this->booking->save();

            if ($this->booking->transaction) {
                $this->booking->transaction->status = 'failed';
                $this->booking->transaction->save();
            }

            session()->flash('success', 'Booking has been cancelled.');
        }
    }

    public function render()
    {
        return view('livewire.admin.bookings.detail');
    }
}
