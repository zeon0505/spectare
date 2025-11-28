<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name'];

    /**
     * The films that belong to the genre.
     */
    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class);
    }
}
