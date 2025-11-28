<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('featured_films', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('film_id')->constrained()->onDelete('cascade');
            $table->enum('section', ['now_showing', 'coming_soon']);
            $table->integer('order')->default(0);
            $table->timestamps();

            // Ensure a film can only be featured once per section
            $table->unique(['film_id', 'section']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('featured_films');
    }
};
