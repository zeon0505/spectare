<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout; // PASTIKAN BARIS INI ADA
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth; // Import Auth facade

class Register extends Component
{
    #[Layout('components.layouts.auth')] // PASTIKAN BARIS INI SEPERTI INI

    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    public function register()
    {
        $this->validate();

        // Simpan data user baru
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'user',
        ]);

        // Login user secara otomatis
        Auth::login($user);

        // Redirect ke halaman dashboard user setelah daftar
        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
