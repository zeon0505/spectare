<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Film;
use App\Observers\FilmObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the Film observer
        Film::observe(FilmObserver::class);
    }
}
