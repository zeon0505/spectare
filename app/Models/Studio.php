<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'capacity', 'image', 'layout'];

    protected $casts = [
        'layout' => 'array',
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
