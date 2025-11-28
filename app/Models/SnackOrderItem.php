<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SnackOrderItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'snack_order_id',
        'snack_id',
        'quantity',
        'price',
    ];

    /**
     * Get the snack order that owns the item.
     */
    public function snackOrder(): BelongsTo
    {
        return $this->belongsTo(SnackOrder::class);
    }

    /**
     * Get the snack associated with the item.
     */
    public function snack(): BelongsTo
    {
        return $this->belongsTo(Snack::class);
    }
}
