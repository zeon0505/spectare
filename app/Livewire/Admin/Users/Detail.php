<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Detail extends Component
{
    public User $user;
    public $activeTab = 'bookings';

    public function mount(User $user)
    {
        $this->user = $user->load([
            'bookings.showtime.film',
            'bookings.transaction',
            'reviews.film',
            'transactions.booking.showtime.film',
        ]);
    }

    public function toggleBlock()
    {
        if ($this->user->is_blocked) {
            // Unblock user
            $this->user->is_blocked = false;
            $this->user->blocked_at = null;
            $this->user->blocked_by = null;
            $this->user->save();
            
            session()->flash('success', 'User berhasil di-unblock.');
        } else {
            // Block user and invalidate all sessions
            $this->user->is_blocked = true;
            $this->user->blocked_at = now();
            $this->user->blocked_by = Auth::id();
            $this->user->save();
            
            // Invalidate all user sessions
            Session::getHandler()->destroy($this->user->id);
            
            session()->flash('success', 'User berhasil di-block dan semua sesi telah diakhiri.');
        }

        $this->user->refresh();
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.admin.users.detail');
    }
}
