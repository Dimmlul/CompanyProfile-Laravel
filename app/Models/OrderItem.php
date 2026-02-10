<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * These fields represent individual items within an order
     * and can be safely filled using create() or update().
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'qty',
    ];

    /**
     * Attribute casting configuration.
     *
     * - price is cast to decimal with 2 decimal places
     *   to ensure accurate monetary calculations
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Accessor: total price for this order item.
     *
     * Calculates the total cost based on:
     * - unit price
     * - quantity purchased
     *
     * @return float
     */
    public function getTotalAttribute()
    {
        return $this->price * $this->qty;
    }

    /**
     * Get the order that this item belongs to.
     *
     * Relationship:
     * - An order item belongs to a single order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product associated with this order item.
     *
     * Relationship:
     * - An order item belongs to a single product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
