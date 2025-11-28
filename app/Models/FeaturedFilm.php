<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeaturedFilm extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['film_id', 'section', 'order'];

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }

    public function scopeNowShowing($query)
    {
        return $query->where('section', 'now_showing')->orderBy('order');
    }

    public function scopeComingSoon($query)
    {
        return $query->where('section', 'coming_soon')->orderBy('order');
    }
}
