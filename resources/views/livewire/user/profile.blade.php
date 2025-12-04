<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">

    <!-- Header -->
    <div class="mb-10 text-center sm:text-left">
        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-300 mb-2 drop-shadow-sm">
            Account Settings
        </h1>
        <p class="text-gray-400 text-sm">Manage your profile information and security.</p>
    </div>

    <!-- 1. Avatar Card -->
    <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 mb-8 overflow-hidden group hover:border-amber-500/30 transition-all duration-500">
        <div class="p-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-slate-800 pb-6 mb-8 gap-4">
                <div>
                    <h2 class="text-xl font-bold text-white">Avatar</h2>
                    <p class="text-xs text-gray-500 mt-1">Update your profile picture.</p>
                </div>
                <div class="flex space-x-4 text-xs font-bold uppercase tracking-wider">
                    @if ($user->profile_photo_path)
                        <button wire:click="deleteProfilePhoto" class="text-red-500 hover:text-red-400 transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Remove
                        </button>
                    @endif
                    <label for="profile_photo" class="text-amber-500 hover:text-amber-400 cursor-pointer transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Change Avatar
                    </label>
                    <input type="file" id="profile_photo" wire:model="profile_photo" class="hidden">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-8">
                <div class="relative group/avatar">
                    <div class="relative w-32 h-32 rounded-full p-1 bg-gradient-to-br from-amber-500 to-slate-800 shadow-xl">
                        @if ($profile_photo)
                            <img src="{{ $profile_photo->temporaryUrl() }}" class="w-full h-full rounded-full object-cover border-4 border-slate-900">
                        @elseif ($user->profile_photo_path)
                            <img src="{{ Storage::url($user->profile_photo_path) }}" class="w-full h-full rounded-full object-cover border-4 border-slate-900">
                        @else
                            <div class="w-full h-full rounded-full bg-slate-800 flex items-center justify-center text-amber-500 text-4xl font-black border-4 border-slate-900">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <!-- Loading Indicator -->
                    <div wire:loading wire:target="profile_photo" class="absolute inset-0 bg-black/60 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <svg class="animate-spin h-8 w-8 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex-1 text-center sm:text-left">
                    @if($profile_photo)
                         <button wire:click="updateProfilePhoto" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-xl text-sm transition-all shadow-lg shadow-amber-500/20 hover:scale-105">
                            Save New Avatar
                        </button>
                        <p class="text-gray-400 text-xs mt-3">Click save to apply changes.</p>
                    @else
                        <h3 class="text-lg font-bold text-white mb-1">{{ $user->name }}</h3>
                        <p class="text-amber-500 text-sm mb-4">{{ $user->email }}</p>
                        <p class="text-slate-500 text-xs">Allowed file types: png, jpg, jpeg. Max size: 2MB.</p>
                    @endif
                     @error('profile_photo') <span class="text-red-500 text-xs mt-2 block font-bold">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Profile Settings Card -->
    <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 mb-8 overflow-hidden group hover:border-amber-500/30 transition-all duration-500">
        <div class="p-8">
            <div class="flex justify-between items-start border-b border-slate-800 pb-6 mb-8">
                <div>
                    <h2 class="text-xl font-bold text-white">Profile Information</h2>
                    <p class="text-xs text-gray-500 mt-1">Update your account's profile information and email address.</p>
                </div>
                <button wire:click="toggleEditProfile" class="text-amber-500 hover:text-amber-400 text-xs font-bold uppercase tracking-wider transition-colors flex items-center gap-1">
                    {{ $isEditingProfile ? 'Cancel' : 'Edit Profile' }}
                </button>
            </div>

            @if($isEditingProfile)
                <form wire:submit.prevent="updateProfileInformation" class="animate-fade-in-up">
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Name</label>
                            <input type="text" wire:model.defer="name" class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl py-3 px-4 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all placeholder-gray-600">
                            @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Email</label>
                            <input type="email" wire:model.defer="email" class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl py-3 px-4 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all placeholder-gray-600">
                            @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex justify-end pt-4">
                             <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-8 rounded-xl transition-all shadow-lg shadow-amber-500/20 hover:scale-105">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="bg-slate-950/50 p-4 rounded-xl border border-slate-800">
                        <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Name</span>
                        <span class="text-lg text-white font-medium">{{ $user->name }}</span>
                    </div>
                    <div class="bg-slate-950/50 p-4 rounded-xl border border-slate-800">
                        <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Email</span>
                        <span class="text-lg text-white font-medium">{{ $user->email }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- 3. Security & Password Card -->
    <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 mb-8 overflow-hidden group hover:border-amber-500/30 transition-all duration-500">
        <div class="p-8">
            <div class="flex justify-between items-start border-b border-slate-800 pb-6 mb-8">
                <div>
                    <h2 class="text-xl font-bold text-white">Security & Password</h2>
                    <p class="text-xs text-gray-500 mt-1">Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <button wire:click="toggleEditPassword" class="text-amber-500 hover:text-amber-400 text-xs font-bold uppercase tracking-wider transition-colors flex items-center gap-1">
                    {{ $isEditingPassword ? 'Cancel' : 'Edit Password' }}
                </button>
            </div>

             @if($isEditingPassword)
                <form wire:submit.prevent="updatePassword" class="animate-fade-in-up">
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Current Password</label>
                            <input type="password" wire:model.defer="current_password" class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl py-3 px-4 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all placeholder-gray-600">
                            @error('current_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">New Password</label>
                                <input type="password" wire:model.defer="new_password" class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl py-3 px-4 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all placeholder-gray-600">
                                @error('new_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                             <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Confirm New Password</label>
                                <input type="password" wire:model.defer="new_password_confirmation" class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl py-3 px-4 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all placeholder-gray-600">
                            </div>
                        </div>
                        <div class="flex justify-end pt-4">
                             <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-8 rounded-xl transition-all shadow-lg shadow-amber-500/20 hover:scale-105">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <div class="flex items-center justify-between bg-slate-950/50 p-6 rounded-xl border border-slate-800">
                    <div>
                        <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Password Status</span>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <span class="text-white font-medium">Secure</span>
                        </div>
                    </div>
                    <div class="text-right">
                         <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Last Changed</span>
                         <span class="text-sm text-gray-400">{{ $user->updated_at->format('d M Y') }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Success Message Toast -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             class="fixed bottom-6 right-6 bg-slate-800 border-l-4 border-green-500 text-white px-6 py-4 rounded-r-xl shadow-2xl flex items-center gap-3 z-50">
            <div class="bg-green-500/20 p-2 rounded-full">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-sm">Success</h4>
                <p class="text-xs text-gray-400">{{ session('message') }}</p>
            </div>
        </div>
    @endif
    
     <!-- Error Message Toast -->
    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             class="fixed bottom-6 right-6 bg-slate-800 border-l-4 border-red-500 text-white px-6 py-4 rounded-r-xl shadow-2xl flex items-center gap-3 z-50">
             <div class="bg-red-500/20 p-2 rounded-full">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-sm">Error</h4>
                <p class="text-xs text-gray-400">{{ session('error') }}</p>
            </div>
        </div>
    @endif

</div>
