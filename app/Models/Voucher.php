<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'code',
        'type',
        'amount',
        'description',
        'min_purchase',
        'max_discount',
        'quota',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'amount' => 'decimal:2',
        'min_purchase' => 'decimal:2',
        'max_discount' => 'decimal:2',
    ];

    public function isValid()
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->quota <= 0) {
            return false;
        }

        $now = now();

        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }

        if ($this->end_date && $now->gt($this->end_date)) {
            return false;
        }

        return true;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('quota', '>', 0)
            ->where(function ($q) {
                $q->whereNull('start_date')
                    ->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            });
    }

    public function isEligibleForUser($userId)
    {
        // Check if user has executed bookings with this voucher
        $usedInBooking = $this->bookings()
            ->where('user_id', $userId)
            ->whereIn('status', ['paid', 'confirmed', 'pending']) // Include pending to prevent double usage during checkout
            ->exists();

        if ($usedInBooking) {
            return false;
        }

        // Check if user has executed snack orders with this voucher
        $usedInSnack = $this->snackOrders()
            ->where('user_id', $userId)
            ->whereIn('status', ['paid', 'confirmed', 'pending', 'success'])
            ->exists();

        if ($usedInSnack) {
            return false;
        }

        return true;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function snackOrders()
    {
        return $this->hasMany(SnackOrder::class);
    }
}
