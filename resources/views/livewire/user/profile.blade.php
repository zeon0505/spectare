<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <!-- Header Halaman (Opsional, agar konsisten) -->
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-amber-500 mb-2 drop-shadow-md">Pengaturan Akun</h1>
        <p class="text-gray-400 text-sm">Kelola informasi profil, keamanan, dan foto akun Anda.</p>
    </div>

    <!-- SECTION 1: INFORMASI PROFIL -->
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <!-- Judul Bagian (Kiri) -->
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-bold text-white">Informasi Profil</h3>
                <p class="mt-2 text-sm text-gray-400">
                    Perbarui informasi profil akun Anda dan alamat email.
                </p>
            </div>
        </div>

        <!-- Form (Kanan) -->
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form wire:submit.prevent="updateProfileInformation">
                <div class="shadow-2xl shadow-black/50 sm:rounded-xl overflow-hidden border border-slate-700">
                    <div class="px-6 py-6 bg-slate-800 sm:p-8">
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <label for="name" class="block font-bold text-sm text-gray-300 mb-2">Nama</label>
                                <input id="name" type="text"
                                    class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-500 transition-all"
                                    wire:model.defer="name" autocomplete="name">
                                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-4">
                                <label for="email" class="block font-bold text-sm text-gray-300 mb-2">Email</label>
                                <input id="email" type="email"
                                    class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-500 transition-all"
                                    wire:model.defer="email">
                                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end px-6 py-4 bg-slate-900/50 border-t border-slate-700 sm:px-8">
                        <button type="submit"
                            class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2 px-6 rounded-lg transition-all shadow-lg shadow-amber-500/20 hover:scale-105 text-sm uppercase tracking-widest">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- DIVIDER -->
    <div class="hidden sm:block">
        <div class="py-10">
            <div class="border-t border-slate-700/50"></div>
        </div>
    </div>

    <!-- SECTION 2: UPDATE PASSWORD -->
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-bold text-white">Perbarui Kata Sandi</h3>
                <p class="mt-2 text-sm text-gray-400">
                    Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
                </p>
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <form wire:submit.prevent="updatePassword">
                <div class="shadow-2xl shadow-black/50 sm:rounded-xl overflow-hidden border border-slate-700">
                    <div class="px-6 py-6 bg-slate-800 sm:p-8">
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Current Password -->
                            <div class="col-span-6 sm:col-span-4">
                                <label for="current_password" class="block font-bold text-sm text-gray-300 mb-2">Kata Sandi Saat Ini</label>
                                <input id="current_password" type="password"
                                    class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-500 transition-all"
                                    wire:model.defer="current_password" autocomplete="current-password">
                                @error('current_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- New Password -->
                            <div class="col-span-6 sm:col-span-4">
                                <label for="new_password" class="block font-bold text-sm text-gray-300 mb-2">Kata Sandi Baru</label>
                                <input id="new_password" type="password"
                                    class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-500 transition-all"
                                    wire:model.defer="new_password" autocomplete="new-password">
                                @error('new_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-span-6 sm:col-span-4">
                                <label for="new_password_confirmation" class="block font-bold text-sm text-gray-300 mb-2">Konfirmasi Kata Sandi Baru</label>
                                <input id="new_password_confirmation" type="password"
                                    class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-500 transition-all"
                                    wire:model.defer="new_password_confirmation" autocomplete="new-password">
                                @error('new_password_confirmation') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-6 py-4 bg-slate-900/50 border-t border-slate-700 sm:px-8">
                        <button type="submit"
                            class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2 px-6 rounded-lg transition-all shadow-lg shadow-amber-500/20 hover:scale-105 text-sm uppercase tracking-widest">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- DIVIDER -->
    <div class="hidden sm:block">
        <div class="py-10">
            <div class="border-t border-slate-700/50"></div>
        </div>
    </div>

    <!-- SECTION 3: FOTO PROFIL -->
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-bold text-white">Foto Profil</h3>
                <p class="mt-2 text-sm text-gray-400">
                    Perbarui foto profil Anda untuk personalisasi akun.
                </p>
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <form wire:submit.prevent="updateProfilePhoto">
                <div class="shadow-2xl shadow-black/50 sm:rounded-xl overflow-hidden border border-slate-700">
                    <div class="px-6 py-6 bg-slate-800 sm:p-8">
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Profile Photo Input -->
                            <div class="col-span-6 sm:col-span-4">
                                <label for="profile_photo" class="block font-bold text-sm text-gray-300 mb-4">Pilih Foto</label>

                                <!-- Preview Area (Optional Layout Improvement) -->
                                <div class="flex items-center gap-6">
                                    <!-- Current Photo -->
                                    @if ($user->profile_photo_path)
                                        <div class="flex-shrink-0">
                                            <img src="{{ Storage::url($user->profile_photo_path) }}" alt="Current Profile Photo"
                                                 class="rounded-full h-20 w-20 object-cover border-2 border-slate-600 shadow-md">
                                        </div>
                                    @endif

                                    <!-- File Input -->
                                    <div class="flex-grow">
                                        <input type="file" id="profile_photo" wire:model="profile_photo"
                                            class="block w-full text-sm text-gray-400
                                            border border-slate-600 rounded-lg cursor-pointer
                                            bg-slate-900 focus:outline-none
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-l-lg file:border-0
                                            file:text-xs file:font-bold
                                            file:bg-amber-500 file:text-slate-900
                                            hover:file:bg-amber-600 transition-all">
                                    </div>
                                </div>

                                @error('profile_photo') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-6 py-4 bg-slate-900/50 border-t border-slate-700 sm:px-8">
                        <button type="submit"
                            class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2 px-6 rounded-lg transition-all shadow-lg shadow-amber-500/20 hover:scale-105 text-sm uppercase tracking-widest">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
