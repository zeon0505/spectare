<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'snack_id',
        'quantity',
    ];

    /**
     * Get the user that owns the cart item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the snack associated with the cart item.
     */
    public function snack()
    {
        return $this->belongsTo(Snack::class);
    }
}
