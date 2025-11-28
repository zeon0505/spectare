<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('poster_url');
            $table->longText('description');
            $table->integer('duration')->default(0); // Menggunakan 'duration' bukan 'duration_minutes'
            $table->date('release_date');
            $table->string('age_rating')->nullable();
            $table->string('status')->default('Coming Soon');
            $table->string('trailer_url')->nullable();
            $table->decimal('ticket_price', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
