<div class="register-section">
    <!-- Logo -->
    <div class="logo">
        <div class="logo-icon">🎬</div>
        <div class="logo-text">Spectare</div>
    </div>

    <h1>Daftar</h1>
    <p class="subtitle">Bergabunglah dengan Spectare dan nikmati pengalaman sinematik terbaik.</p>

    <form wire:submit.prevent="register">
        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" wire:model="email" placeholder="Masukkan email Anda" required>
            @error('email')
                <small style="color:#f87171; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <!-- Nama Lengkap -->
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" wire:model="name" placeholder="Masukkan nama lengkap" required>
            @error('name')
                <small style="color:#f87171; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" wire:model="password" placeholder="Buat password yang kuat" required>
            @error('password')
                <small style="color:#f87171; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation" placeholder="Ulangi password Anda" required>
        </div>

        <!-- Terms Checkbox -->
        <div class="checkbox-group">
            <input type="checkbox" id="terms" required>
            <label for="terms">Saya setuju dengan <a href="#">Syarat & Ketentuan</a></label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-register">Daftar Sekarang</button>
    </form>

    <div class="footer-links">
        <div>
            <span style="color: #a0a8c0;">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></span>
        </div>
    </div>
</div>
