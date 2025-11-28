<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
        $table->foreignUuid('film_id')->constrained()->onDelete('cascade');
        $table->integer('rating')->default(0); // misal 1-5 bintang
        $table->text('comment')->nullable();
        $table->boolean('is_approved')->default(false); // admin bisa verifikasi
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
