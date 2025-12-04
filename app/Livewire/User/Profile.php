<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $profile_photo;
    public $user;
    public $isEditingProfile = false;
    public $isEditingPassword = false;

    public function toggleEditProfile()
    {
        $this->isEditingProfile = !$this->isEditingProfile;
        if (!$this->isEditingProfile) {
            $this->mount(); // Reset data if cancelling
        }
    }

    public function toggleEditPassword()
    {
        $this->isEditingPassword = !$this->isEditingPassword;
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }


    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function render()
    {
        return view('livewire.user.profile');
    }

    public function updateProfileInformation()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
        ]);

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->save();

        session()->flash('message', 'Profil berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($this->current_password, $this->user->password)) {
            session()->flash('error', 'Kata sandi saat ini salah.');
            return;
        }

        $this->user->password = Hash::make($this->new_password);
        $this->user->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('message', 'Kata sandi berhasil diperbarui.');
    }

    public function updateProfilePhoto()
    {
        $this->validate([
            'profile_photo' => ['nullable', 'image', 'max:1024'], // 1MB Max
        ]);

        // Tambahkan ini untuk memeriksa apakah validasi berhasil dan file ada
        if (!$this->profile_photo) {
            session()->flash('error', 'Tidak ada foto profil yang dipilih.');
            return;
        }

        try {
            $path = $this->profile_photo->store('profile-photos', 'public');
            $this->user->profile_photo_path = $path;
            $this->user->save();
            session()->flash('message', 'Foto profil berhasil diperbarui.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengunggah foto profil: ' . $e->getMessage());
        }
    }
}
