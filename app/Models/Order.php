<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $fillable = [
        'user_id',
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
    // 'midtrans_response' => 'array',
    ];

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
