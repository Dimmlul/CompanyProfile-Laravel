<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'qty',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Total price for this item
     */
    public function getTotalAttribute()
    {
        return $this->price * $this->qty;
    }

    /**
     * Relationship to Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relationship to Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
