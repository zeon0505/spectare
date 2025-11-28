<?php

use App\Models\User;
use App\Models\Studio;
use App\Models\Genre;
use App\Models\Film;
use App\Models\Showtime;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Creating User...\n";
    User::factory()->create();
    echo "User created.\n";

    echo "Creating Studio...\n";
    Studio::factory()->create();
    echo "Studio created.\n";

    echo "Creating Genres...\n";
    Genre::factory()->count(3)->create();
    echo "Genres created.\n";

    echo "Creating Film...\n";
    Film::factory()->create();
    echo "Film created.\n";

    echo "Creating Showtime...\n";
    Showtime::factory()->create();
    echo "Showtime created.\n";

    echo "All factories working!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
