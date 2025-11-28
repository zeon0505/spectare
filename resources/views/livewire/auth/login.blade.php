<div class="register-section">
    <!-- Logo -->
    <div class="logo">
        <div class="logo-icon">🎬</div>
        <div class="logo-text">Spectare</div>
    </div>

    <h1>Login</h1>
    <p class="subtitle">Masuk kembali untuk melanjutkan petualangan sinematik Anda bersama Spectare.</p>

    <form wire:submit.prevent="login">
        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" wire:model="email" placeholder="Masukkan email Anda" required>
            @error('email')
                <small style="color:#f87171; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" wire:model="password" placeholder="Masukkan password Anda" required>
            @error('password')
                <small style="color:#f87171; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <!-- Checkbox & Forgot Password -->
        <div class="checkbox-group" style="justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" id="remember" wire:model="remember">
                <label for="remember">Ingat Saya</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size: 14px;">Lupa Password?</a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-register">Masuk</button>
    </form>

    <div class="footer-links">
        <div>
            <span style="color: #a0a8c0;">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></span>
        </div>
    </div>
</div>
