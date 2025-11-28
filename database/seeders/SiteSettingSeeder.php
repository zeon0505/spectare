<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Homepage Hero Section
            [
                'key' => 'hero_title',
                'value' => 'Experience Cinema Like Never Before',
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Book your tickets now and immerse yourself in the magic of movies',
                'type' => 'textarea',
                'group' => 'homepage',
            ],
            [
                'key' => 'hero_cta_text',
                'value' => 'Explore Now',
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'hero_cta_secondary',
                'value' => 'Coming Soon',
                'type' => 'text',
                'group' => 'homepage',
            ],
            [
                'key' => 'hero_background',
                'value' => 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=1600&auto=format&fit=crop',
                'type' => 'image',
                'group' => 'homepage',
            ],
            
            // General Site Settings
            [
                'key' => 'site_tagline',
                'value' => 'Your Ultimate Movie Destination',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'footer_text',
                'value' => '© 2025 Cinemaspectare. All rights reserved.',
                'type' => 'text',
                'group' => 'general',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
