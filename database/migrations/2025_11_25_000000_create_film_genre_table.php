<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('film_genre', function (Blueprint $table) {
            $table->foreignUuid('film_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('genre_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Composite primary key for pivot table
            $table->primary(['film_id', 'genre_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_genre');
    }
};
