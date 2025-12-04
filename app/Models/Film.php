<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Film extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'description',
        'release_date',
        'duration', // <-- Dikembalikan ke 'duration'
        'status',
        'poster_url',
        'trailer_url',
        'ticket_price',
        'age_rating',
    ];

    protected $casts = [
        'release_date' => 'date',
        'ticket_price' => 'decimal:2', // Memperbaiki casting
    ];


    /**
     * The genres that belong to the film.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Get the average rating from approved reviews
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()
            ->where('is_approved', true)
            ->avg('rating');
    }

    /**
     * Get the total count of approved reviews
     */
    public function getReviewCountAttribute()
    {
        return $this->reviews()
            ->where('is_approved', true)
            ->count();
    }
}
