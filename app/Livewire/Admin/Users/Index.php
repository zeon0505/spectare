<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = '';
    public $statusFilter = '';

    public function toggleBlock($userId)
    {
        $user = User::findOrFail($userId);
        
        if ($user->is_blocked) {
            // Unblock user
            $user->is_blocked = false;
            $user->blocked_at = null;
            $user->blocked_by = null;
            $user->save();
            
            session()->flash('success', 'User berhasil di-unblock.');
        } else {
            // Block user and invalidate all sessions
            $user->is_blocked = true;
            $user->blocked_at = now();
            $user->blocked_by = Auth::id();
            $user->save();
            
            // Invalidate all user sessions
            Session::getHandler()->destroy($user->id);
            
            session()->flash('success', 'User berhasil di-block dan semua sesi telah diakhiri.');
        }
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->roleFilter, function ($query) {
                $query->where('role', $this->roleFilter);
            })
            ->when($this->statusFilter !== '', function ($query) {
                if ($this->statusFilter === 'blocked') {
                    $query->where('is_blocked', true);
                } else {
                    $query->where('is_blocked', false);
                }
            })
            ->withCount('bookings')
            ->latest()
            ->paginate(15);

        return view('livewire.admin.users.index', [
            'users' => $users,
        ]);
    }
}
