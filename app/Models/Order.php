<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * These fields represent the core order and payment data
     * and can be safely filled using create() or update().
     */
    protected $fillable = [
        'user_id',
        'customer_email',
        'order_number',
        'total',
        'payment_status',
        'payment_token',
        'payment_method',
        'midtrans_transaction_id',
        'midtrans_response',
    ];

    /**
     * Attribute casting configuration.
     *
     * - total is cast to integer for accurate monetary calculations
     * - midtrans_response is cast to array for structured payment data storage
     */
    protected $casts = [
        'total' => 'integer',
        'midtrans_response' => 'array',
    ];

    /**
     * Use order_number instead of the ID for route model binding.
     *
     * This allows URLs such as:
     * /orders/ORD-20260204-123
     *
     * Improves security and readability by avoiding sequential IDs.
     */
    public function getRouteKeyName()
    {
        return 'order_number';
    }

    /**
     * Calculate the total price of the order based on its items.
     *
     * Responsibilities:
     * - Sum (price × quantity) for each order item
     * - Return the computed total amount
     */
    public function calculateTotal()
    {
        return $this->items->sum(
            fn ($item) => $item->price * $item->qty
        );
    }

    /**
     * Get the order items associated with this order.
     *
     * Relationship:
     * - An order can have many order items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the user who placed this order.
     *
     * Relationship:
     * - An order belongs to a single user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
