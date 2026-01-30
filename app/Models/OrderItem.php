<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'price', 'qty'];

    protected $casts = [
    'total_price' => 'decimal:2',
    ];

    public function calculateTotal()
    {
    return $this->price * $this->qty    ;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
