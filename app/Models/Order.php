<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

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

    protected $casts = [
        'total' => 'integer',
        'midtrans_response' => 'array',
    ];

    /**
     * Gunakan order_number sebagai route key (BUKAN id)
     * contoh URL: /orders/ORDER-20260204-RDRQ
     */
    public function getRouteKeyName()
    {
        return 'order_number';
    }

    public function calculateTotal()
    {
        return $this->items->sum(fn ($item) => $item->price * $item->qty);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
