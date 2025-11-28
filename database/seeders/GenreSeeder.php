<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Action', 'description' => 'Film penuh aksi dan pertarungan.'],
            ['name' => 'Drama', 'description' => 'Film dengan emosi dan cerita mendalam.'],
            ['name' => 'Comedy', 'description' => 'Film lucu dan menghibur.'],
            ['name' => 'Horror', 'description' => 'Film menegangkan dan menyeramkan.'],
            ['name' => 'Romance', 'description' => 'Film bertema cinta dan hubungan.'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
