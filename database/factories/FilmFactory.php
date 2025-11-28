<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $posters = [
            'https://image.tmdb.org/t/p/w500/q6y0Go1tsGEsmtFryDOJo3dEmqu.jpg', // The Shawshank Redemption
            'https://image.tmdb.org/t/p/w500/3bhkrj58Vtu7enYsRolD1fZdja1.jpg', // The Godfather
            'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg', // The Dark Knight
            'https://image.tmdb.org/t/p/w500/d5iIlFn5s0ImszYzBPb8JPIfbXD.jpg', // Pulp Fiction
            'https://image.tmdb.org/t/p/w500/arw2vcBveWOVZr6pxd9XTd1Qa.jpg',   // Forrest Gump
            'https://image.tmdb.org/t/p/w500/rCzpDGLbOoPwLjy3OAm5NUPOTrC.jpg', // The Lord of the Rings: The Return of the King
            'https://image.tmdb.org/t/p/w500/8OKmBV5BUFzmoz4zCszi1Tz0k5A.jpg', // Fight Club
            'https://image.tmdb.org/t/p/w500/suaEOtk1N1sgg2MTM7oZd2cfVp3.jpg', // Inception
            'https://image.tmdb.org/t/p/w500/5A2b0G3iG3a3s291yP32a42gY3b.jpg', // The Matrix
            'https://image.tmdb.org/t/p/w500/aKuFiU82s5ISJpGZp7YkAh3FNRj.jpg', // The Silence of the Lambs
        ];

        return [
            'title' => $this->faker->sentence(3),
            // 'genre_id' => Genre::inRandomOrder()->first()->id, // Hapus baris ini
            'description' => $this->faker->paragraph(5),
            'poster_url' => $this->faker->randomElement($posters),
            'trailer_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'duration' => $this->faker->numberBetween(90, 180),
            'release_date' => $this->faker->date(),
            'ticket_price' => $this->faker->numberBetween(35000, 75000),
            'status' => $this->faker->randomElement(['Now Showing', 'Coming Soon']),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Film $film) {
            // Ambil 1 sampai 3 genre secara acak
            $genres = Genre::inRandomOrder()->take($this->faker->numberBetween(1, 3))->pluck('id');
            $film->genres()->attach($genres);
        });
    }
}
