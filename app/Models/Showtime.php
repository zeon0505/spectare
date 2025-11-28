<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Showtime extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['film_id', 'studio_id', 'date', 'time'];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i', // Ini mengembalikan objek Carbon
    ];

    public function getStartTimeAttribute()
    {
        return Carbon::parse($this->date->format('Y-m-d') . ' ' . $this->time->format('H:i:s'));
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
