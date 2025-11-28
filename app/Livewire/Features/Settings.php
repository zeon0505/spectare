<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Settings extends Component
{
    public $name;
    public $email;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function save()
    {
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        session()->flash('success', 'Profile successfully updated.');

        return $this->redirect(route('settings'), navigate: true);
    }

    public function render()
    {
        return view('livewire.features.settings');
    }
}
