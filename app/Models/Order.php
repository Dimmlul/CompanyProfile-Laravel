<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $fillable = ['user_id', 'total_price', 'status'];

    protected $casts = [
    'total_price' => 'decimal:2',
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
