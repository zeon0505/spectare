<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SnackOrder extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    /**
     * Get the user that owns the snack order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the snack order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(SnackOrderItem::class);
    }
}
