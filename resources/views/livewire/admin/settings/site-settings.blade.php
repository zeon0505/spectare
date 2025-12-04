<div class="p-6 sm:p-10 max-w-7xl mx-auto">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-300 drop-shadow-sm mb-2">
                Site Settings
            </h1>
            <p class="text-gray-400 text-sm">Manage your website content, appearance, and featured films.</p>
        </div>
    </div>

    @if(session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             class="mb-6 bg-green-500/10 border-l-4 border-green-500 text-green-400 px-6 py-4 rounded-r-lg shadow-lg flex items-center gap-3 animate-fade-in-up">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="save">
        <!-- Homepage Hero Section -->
        <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 p-8 mb-8 group hover:border-amber-500/30 transition-all duration-500">
            <div class="border-b border-slate-800 pb-4 mb-6">
                <h2 class="text-xl font-bold text-white">Homepage Hero Section</h2>
                <p class="text-xs text-gray-500 mt-1">Customize the main banner of your homepage.</p>
            </div>
            
            <div class="space-y-6">
                <div>
                    <label for="hero_title" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Hero Title</label>
                    <input type="text" wire:model="hero_title" id="hero_title"
                           class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all placeholder-gray-600">
                    @error('hero_title') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="hero_subtitle" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Hero Subtitle</label>
                    <textarea wire:model="hero_subtitle" id="hero_subtitle" rows="3"
                              class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all placeholder-gray-600"></textarea>
                    @error('hero_subtitle') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="hero_cta_text" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Primary CTA Button Text</label>
                        <input type="text" wire:model="hero_cta_text" id="hero_cta_text"
                               class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all placeholder-gray-600">
                        @error('hero_cta_text') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="hero_cta_secondary" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Secondary CTA Button Text</label>
                        <input type="text" wire:model="hero_cta_secondary" id="hero_cta_secondary"
                               class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all placeholder-gray-600">
                        @error('hero_cta_secondary') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="hero_background" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Hero Background Image</label>
                    
                    @if($hero_background_preview)
                        <div class="mb-4 relative group/image overflow-hidden rounded-xl border border-slate-700">
                            <img src="{{ str_starts_with($hero_background_preview, 'http') ? $hero_background_preview : Storage::url($hero_background_preview) }}" 
                                 alt="Current Background" 
                                 class="w-full h-48 object-cover transition-transform duration-500 group-hover/image:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover/image:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <span class="text-white text-xs font-bold">Current Preview</span>
                            </div>
                        </div>
                    @endif

                    <input type="file" wire:model="hero_background" id="hero_background" accept="image/*"
                           class="block w-full text-sm text-gray-400
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-l-xl file:border-0
                                  file:text-xs file:font-bold file:uppercase file:tracking-wider
                                  file:bg-slate-800 file:text-amber-500
                                  hover:file:bg-slate-700
                                  bg-slate-950 border border-slate-700 rounded-xl cursor-pointer focus:outline-none transition-all">
                    <p class="text-xs text-gray-500 mt-2">Upload a new background image (max 2MB). Leave empty to keep current image.</p>
                    @error('hero_background') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    
                    @if($hero_background)
                        <div class="mt-2 text-xs font-bold text-green-400 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            New image selected: {{ $hero_background->getClientOriginalName() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- General Settings -->
        <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 p-8 mb-8 group hover:border-amber-500/30 transition-all duration-500">
            <div class="border-b border-slate-800 pb-4 mb-6">
                <h2 class="text-xl font-bold text-white">General Settings</h2>
                <p class="text-xs text-gray-500 mt-1">Basic configuration for your site identity.</p>
            </div>
            
            <div class="space-y-6">
                <div>
                    <label for="site_tagline" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Site Tagline</label>
                    <input type="text" wire:model="site_tagline" id="site_tagline"
                           class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all placeholder-gray-600">
                    @error('site_tagline') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="footer_text" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Footer Text</label>
                    <input type="text" wire:model="footer_text" id="footer_text"
                           class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all placeholder-gray-600">
                    @error('footer_text') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="logo" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Site Logo</label>
                    
                    @if($logo_preview)
                        <div class="mb-4 p-4 bg-slate-950 border border-slate-800 rounded-xl inline-block">
                            <img src="{{ str_starts_with($logo_preview, 'http') ? $logo_preview : Storage::url($logo_preview) }}" 
                                 alt="Current Logo" 
                                 class="h-16 w-auto object-contain">
                        </div>
                    @endif

                    <input type="file" wire:model="logo" id="logo" accept="image/*"
                           class="block w-full text-sm text-gray-400
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-l-xl file:border-0
                                  file:text-xs file:font-bold file:uppercase file:tracking-wider
                                  file:bg-slate-800 file:text-amber-500
                                  hover:file:bg-slate-700
                                  bg-slate-950 border border-slate-700 rounded-xl cursor-pointer focus:outline-none transition-all">
                    <p class="text-xs text-gray-500 mt-2">Upload a new logo (max 1MB). Leave empty to keep current logo.</p>
                    @error('logo') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    
                    @if($logo)
                        <div class="mt-2 text-xs font-bold text-green-400 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            New logo selected: {{ $logo->getClientOriginalName() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Featured Films Selection -->
        <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 p-8 mb-8 group hover:border-amber-500/30 transition-all duration-500">
            <div class="border-b border-slate-800 pb-4 mb-6">
                <h2 class="text-xl font-bold text-white">Featured Films on Homepage</h2>
                <p class="text-xs text-gray-500 mt-1">Select which films to highlight in key sections.</p>
            </div>
            
            <div class="space-y-6">
                <div>
                    <label for="nowShowingFilms" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Now Showing Films</label>
                    <select wire:model="nowShowingFilms" id="nowShowingFilms" multiple size="8"
                            class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-slate-900">
                        @foreach($allFilms as $film)
                            <option value="{{ $film->id }}" class="py-1 px-2 hover:bg-slate-800 rounded cursor-pointer">{{ $film->title }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Hold Ctrl (Windows) or Cmd (Mac) to select multiple films
                    </p>
                    @error('nowShowingFilms') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="comingSoonFilms" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Coming Soon Films</label>
                    <select wire:model="comingSoonFilms" id="comingSoonFilms" multiple size="8"
                            class="w-full bg-slate-950 text-white border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-slate-900">
                        @foreach($allFilms as $film)
                            <option value="{{ $film->id }}" class="py-1 px-2 hover:bg-slate-800 rounded cursor-pointer">{{ $film->title }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Hold Ctrl (Windows) or Cmd (Mac) to select multiple films
                    </p>
                    @error('comingSoonFilms') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end pt-4 border-t border-slate-800">
            <button type="submit"
                    class="px-8 py-3 bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold rounded-xl transition-all shadow-lg shadow-amber-500/20 hover:scale-105 transform">
                Save Settings
            </button>
        </div>
    </form>
</div>
