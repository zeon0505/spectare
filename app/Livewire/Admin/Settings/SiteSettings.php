<?php

namespace App\Livewire\Admin\Settings;

use App\Models\SiteSetting;
use App\Models\Film;
use App\Models\FeaturedFilm;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.admin')]
class SiteSettings extends Component
{
    use WithFileUploads;

    public $hero_title;
    public $hero_subtitle;
    public $hero_cta_text;
    public $hero_cta_secondary;
    public $hero_background;
    public $hero_background_preview;
    public $site_tagline;
    public $footer_text;
    public $logo;
    public $logo_preview;
    
    public $nowShowingFilms = [];
    public $comingSoonFilms = [];
    public $allFilms;

    public function mount()
    {
        $this->hero_title = SiteSetting::get('hero_title', 'Experience Cinema Like Never Before');
        $this->hero_subtitle = SiteSetting::get('hero_subtitle', 'Book your tickets now and immerse yourself in the magic of movies');
        $this->hero_cta_text = SiteSetting::get('hero_cta_text', 'Explore Now');
        $this->hero_cta_secondary = SiteSetting::get('hero_cta_secondary', 'Coming Soon');
        $this->hero_background_preview = SiteSetting::get('hero_background', 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=1600&auto=format&fit=crop');
        $this->site_tagline = SiteSetting::get('site_tagline', 'Your Ultimate Movie Destination');
        $this->footer_text = SiteSetting::get('footer_text', '© 2025 Cinemaspectare. All rights reserved.');
        $this->logo_preview = SiteSetting::get('logo');
        
        // Load all films for selection
        $this->allFilms = Film::orderBy('title')->get();
        
        // Load currently featured films
        $this->nowShowingFilms = FeaturedFilm::nowShowing()->pluck('film_id')->toArray();
        $this->comingSoonFilms = FeaturedFilm::comingSoon()->pluck('film_id')->toArray();
    }

    public function save()
    {
        $this->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:500',
            'hero_cta_text' => 'required|string|max:50',
            'hero_cta_secondary' => 'required|string|max:50',
            'hero_background' => 'nullable|image|max:2048',
            'site_tagline' => 'required|string|max:255',
            'footer_text' => 'required|string|max:255',
            'logo' => 'nullable|image|max:1024',
            'nowShowingFilms' => 'array',
            'comingSoonFilms' => 'array',
        ]);

        SiteSetting::set('hero_title', $this->hero_title, 'text', 'homepage');
        SiteSetting::set('hero_subtitle', $this->hero_subtitle, 'textarea', 'homepage');
        SiteSetting::set('hero_cta_text', $this->hero_cta_text, 'text', 'homepage');
        SiteSetting::set('hero_cta_secondary', $this->hero_cta_secondary, 'text', 'homepage');
        
        // Handle hero background upload
        if ($this->hero_background) {
            $oldBackground = SiteSetting::get('hero_background');
            if ($oldBackground && !str_starts_with($oldBackground, 'http') && Storage::disk('public')->exists($oldBackground)) {
                Storage::disk('public')->delete($oldBackground);
            }
            
            $path = $this->hero_background->store('backgrounds', 'public');
            SiteSetting::set('hero_background', $path, 'image', 'homepage');
        }

        // Handle logo upload
        if ($this->logo) {
            $oldLogo = SiteSetting::get('logo');
            if ($oldLogo && !str_starts_with($oldLogo, 'http') && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            
            $path = $this->logo->store('logos', 'public');
            SiteSetting::set('logo', $path, 'image', 'general');
        }

        SiteSetting::set('site_tagline', $this->site_tagline, 'text', 'general');
        SiteSetting::set('footer_text', $this->footer_text, 'text', 'general');
        
        // Save featured films
        FeaturedFilm::where('section', 'now_showing')->delete();
        foreach ($this->nowShowingFilms as $index => $filmId) {
            FeaturedFilm::create([
                'film_id' => $filmId,
                'section' => 'now_showing',
                'order' => $index,
            ]);
        }
        
        FeaturedFilm::where('section', 'coming_soon')->delete();
        foreach ($this->comingSoonFilms as $index => $filmId) {
            FeaturedFilm::create([
                'film_id' => $filmId,
                'section' => 'coming_soon',
                'order' => $index,
            ]);
        }

        session()->flash('success', 'Site settings updated successfully!');
        
        // Refresh preview
        $this->hero_background_preview = SiteSetting::get('hero_background');
        $this->hero_background = null;
        $this->logo_preview = SiteSetting::get('logo');
        $this->logo = null;
    }

    public function render()
    {
        return view('livewire.admin.settings.site-settings');
    }
}
