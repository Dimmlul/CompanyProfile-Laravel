<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * These fields can be safely filled using create() or update().
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
    ];

    /**
     * Get the product associated with this cart item.
     *
     * Relationship:
     * - Each cart item belongs to a single product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user who owns this cart item.
     *
     * Relationship:
     * - Each cart item belongs to a single user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
