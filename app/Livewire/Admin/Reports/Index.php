<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Film;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

#[Layout('components.layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $startDate;
    public $endDate;
    public $selectedFilm = '';

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function render()
    {
        $transactions = Transaction::query()
            ->with(['user', 'booking.showtime.film', 'booking.showtime.studio'])
            ->where('status', 'success')
            ->when($this->startDate, function ($query) {
                $query->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                $query->whereDate('created_at', '<=', $this->endDate);
            })
            ->when($this->selectedFilm, function ($query) {
                $query->whereHas('booking.showtime.film', function ($q) {
                    $q->where('id', $this->selectedFilm);
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.reports.index', [
            'transactions' => $transactions,
            'films' => Film::all(),
            'totalRevenue' => $this->calculateTotalRevenue(),
        ]);
    }

    public function calculateTotalRevenue()
    {
        return Transaction::query()
            ->where('status', 'success')
            ->when($this->startDate, function ($query) {
                $query->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                $query->whereDate('created_at', '<=', $this->endDate);
            })
            ->when($this->selectedFilm, function ($query) {
                $query->whereHas('booking.showtime.film', function ($q) {
                    $q->where('id', $this->selectedFilm);
                });
            })
            ->sum('amount');
    }

    public function exportCsv()
    {
        $fileName = 'sales-report-' . Carbon::now()->format('Y-m-d') . '.csv';

        $transactions = Transaction::query()
            ->with(['user', 'booking.showtime.film', 'booking.showtime.studio'])
            ->where('status', 'success')
            ->when($this->startDate, function ($query) {
                $query->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                $query->whereDate('created_at', '<=', $this->endDate);
            })
            ->when($this->selectedFilm, function ($query) {
                $query->whereHas('booking.showtime.film', function ($q) {
                    $q->where('id', $this->selectedFilm);
                });
            })
            ->latest()
            ->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['ID', 'Date', 'User', 'Film', 'Studio', 'Seats', 'Amount', 'Status'];

        $callback = function () use ($transactions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($transactions as $transaction) {
                $seats = $transaction->seats ? implode(', ', json_decode($transaction->seats)) : '-';
                
                fputcsv($file, [
                    $transaction->id,
                    $transaction->created_at->format('Y-m-d H:i'),
                    $transaction->user->name ?? 'Guest',
                    $transaction->booking->showtime->film->title ?? '-',
                    $transaction->booking->showtime->studio->name ?? '-',
                    $seats,
                    $transaction->amount,
                    $transaction->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
