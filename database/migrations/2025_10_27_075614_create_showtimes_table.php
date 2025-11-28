<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('showtimes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('film_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('studio_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('showtimes');
    }
};
