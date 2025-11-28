<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Studio;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studios = [
            ['name' => 'Studio 1', 'capacity' => 50],
            ['name' => 'Studio 2', 'capacity' => 60],
            ['name' => 'Studio 3', 'capacity' => 70],
        ];

        // A standard layout example
        $standardLayout = [
            "SSSS_SSSS",
            "SSSS_SSSS",
            "SSSSSSSSS",
            "SSSSSSSSS",
            "SSSSSSSSS",
        ];

        foreach ($studios as $studioData) {
            Studio::updateOrCreate(
                ['name' => $studioData['name']],
                [
                    'capacity' => $studioData['capacity'],
                    'layout' => $standardLayout, // Assigning the layout here
                ]
            );
        }
    }
}
