<div class="p-6 sm:p-10">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-amber-500 drop-shadow-md">
                Site Settings
            </h1>
            <p class="text-gray-400 mt-1">Manage your website content and appearance</p>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <!-- Homepage Hero Section -->
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-white mb-4">Homepage Hero Section</h2>
            
            <div class="space-y-4">
                <div>
                    <label for="hero_title" class="block text-sm font-medium text-gray-300 mb-2">Hero Title</label>
                    <input type="text" wire:model="hero_title" id="hero_title"
                           class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-500">
                    @error('hero_title') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="hero_subtitle" class="block text-sm font-medium text-gray-300 mb-2">Hero Subtitle</label>
                    <textarea wire:model="hero_subtitle" id="hero_subtitle" rows="3"
                              class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-500"></textarea>
                    @error('hero_subtitle') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="hero_cta_text" class="block text-sm font-medium text-gray-300 mb-2">Primary CTA Button Text</label>
                        <input type="text" wire:model="hero_cta_text" id="hero_cta_text"
                               class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-500">
                        @error('hero_cta_text') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="hero_cta_secondary" class="block text-sm font-medium text-gray-300 mb-2">Secondary CTA Button Text</label>
                        <input type="text" wire:model="hero_cta_secondary" id="hero_cta_secondary"
                               class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-500">
                        @error('hero_cta_secondary') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="hero_background" class="block text-sm font-medium text-gray-300 mb-2">Hero Background Image</label>
                    
                    @if($hero_background_preview)
                        <div class="mb-3">
                            <img src="{{ str_starts_with($hero_background_preview, 'http') ? $hero_background_preview : Storage::url($hero_background_preview) }}" 
                                 alt="Current Background" 
                                 class="w-full h-48 object-cover rounded-lg border border-slate-600">
                        </div>
                    @endif

                    <input type="file" wire:model="hero_background" id="hero_background" accept="image/*"
                           class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-500">
                    <p class="text-xs text-gray-400 mt-1">Upload a new background image (max 2MB). Leave empty to keep current image.</p>
                    @error('hero_background') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    
                    @if($hero_background)
                        <div class="mt-2 text-sm text-green-400">New image selected: {{ $hero_background->getClientOriginalName() }}</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- General Settings -->
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-white mb-4">General Settings</h2>
            
            <div class="space-y-4">
                <div>
                    <label for="site_tagline" class="block text-sm font-medium text-gray-300 mb-2">Site Tagline</label>
                    <input type="text" wire:model="site_tagline" id="site_tagline"
                           class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-500">
                    @error('site_tagline') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="footer_text" class="block text-sm font-medium text-gray-300 mb-2">Footer Text</label>
                    <input type="text" wire:model="footer_text" id="footer_text"
                           class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-500">
                    @error('footer_text') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-300 mb-2">Site Logo</label>
                    
                    @if($logo_preview)
                        <div class="mb-3">
                            <img src="{{ str_starts_with($logo_preview, 'http') ? $logo_preview : Storage::url($logo_preview) }}" 
                                 alt="Current Logo" 
                                 class="h-16 w-auto object-contain rounded-lg border border-slate-600 bg-slate-900 p-2">
                        </div>
                    @endif

                    <input type="file" wire:model="logo" id="logo" accept="image/*"
                           class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-500">
                    <p class="text-xs text-gray-400 mt-1">Upload a new logo (max 1MB). Leave empty to keep current logo.</p>
                    @error('logo') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    
                    @if($logo)
                        <div class="mt-2 text-sm text-green-400">New logo selected: {{ $logo->getClientOriginalName() }}</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Featured Films Selection -->
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-white mb-4">Featured Films on Homepage</h2>
            
            <div class="space-y-4">
                <div>
                    <label for="nowShowingFilms" class="block text-sm font-medium text-gray-300 mb-2">Now Showing Films</label>
                    <select wire:model="nowShowingFilms" id="nowShowingFilms" multiple size="8"
                            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-500">
                        @foreach($allFilms as $film)
                            <option value="{{ $film->id }}">{{ $film->title }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-400 mt-1">Hold Ctrl (Windows) or Cmd (Mac) to select multiple films</p>
                    @error('nowShowingFilms') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="comingSoonFilms" class="block text-sm font-medium text-gray-300 mb-2">Coming Soon Films</label>
                    <select wire:model="comingSoonFilms" id="comingSoonFilms" multiple size="8"
                            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-500">
                        @foreach($allFilms as $film)
                            <option value="{{ $film->id }}">{{ $film->title }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-400 mt-1">Hold Ctrl (Windows) or Cmd (Mac) to select multiple films</p>
                    @error('comingSoonFilms') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold rounded-lg transition-colors">
                Save Settings
            </button>
        </div>
    </form>
</div>
