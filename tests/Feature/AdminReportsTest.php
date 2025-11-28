<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Film;
use App\Models\Showtime;
use App\Models\Studio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminReportsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_reports_page()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.reports.index'))
            ->assertStatus(200)
            ->assertSee('Laporan Penjualan');
    }

    public function test_reports_can_be_filtered()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $studio = Studio::factory()->create();
        $film = Film::factory()->create();
        $showtime = Showtime::factory()->create(['film_id' => $film->id, 'studio_id' => $studio->id]);
        
        Transaction::create([
            'user_id' => $admin->id,
            'showtime_id' => $showtime->id,
            'amount' => 50000,
            'status' => 'success',
            'seats' => json_encode(['A1']),
            'order_id' => 'ORD-123',
            'payment_type' => 'credit_card',
            'transaction_time' => now(),
            'fraud_status' => 'accept',
        ]);

        Livewire::actingAs($admin)
            ->test(\App\Livewire\Admin\Reports\Index::class)
            ->set('startDate', now()->subDay()->format('Y-m-d'))
            ->set('endDate', now()->addDay()->format('Y-m-d'))
            ->assertSee($film->title)
            ->assertSee('Rp 50.000');
    }
}
