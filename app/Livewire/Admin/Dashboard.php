<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use App\Models\Film;
use App\Models\Showtime;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    public function updateFilmStatus($filmId, $status)
    {
        $film = Film::find($filmId);
        if ($film) {
            $film->status = $status;
            $film->save();
        }
    }

    public function render()
    {
        // Chart Data (Monthly Sales for Current Year)
        $monthlySales = Transaction::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total')
        )
            ->where('status', 'success')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->get();

        $labels = [];
        $data = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $month = Carbon::create()->month($i)->format('M'); // Jan, Feb, etc.
            $labels[] = $month;
            $sale = $monthlySales->firstWhere('month', $i);
            $data[] = $sale ? $sale->total : 0;
        }

        $chartData = [
            'labels' => $labels,
            'series' => $data,
        ];

        // Bookings Chart Data
        $bookings = Booking::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->get();

        $bookingLabels = [];
        $bookingData = [];

        for ($i = 1; $i <= 12; $i++) {
            $month = Carbon::create()->month($i)->format('F');
            $bookingLabels[] = $month;
            $booking = $bookings->firstWhere('month', $i);
            $bookingData[] = $booking ? $booking->total : 0;
        }

        $bookingsChartData = [
            'labels' => $bookingLabels,
            'series' => $bookingData,
        ];

        // Stats Cards Data
        $totalFilms = Film::count();
        $totalBookings = Booking::count();
        $totalRevenue = Transaction::where('status', 'success')->sum('amount');
        $activeShows = Showtime::where('date', '>=', Carbon::today())->count();
        $nowShowingFilms = Film::with('genres')->where('status', 'Now Showing')->take(2)->get();
        $comingSoonFilms = Film::with('genres')->where('status', 'Coming Soon')->take(2)->get();

        return view('livewire.admin.dashboard', [
            'chartData' => $chartData,
            'bookingsChartData' => $bookingsChartData,
            'totalFilms' => $totalFilms,
            'totalBookings' => $totalBookings,
            'totalRevenue' => $totalRevenue,
            'activeShows' => $activeShows,
            'nowShowingFilms' => $nowShowingFilms,
            'comingSoonFilms' => $comingSoonFilms,
        ]);
    }
}
