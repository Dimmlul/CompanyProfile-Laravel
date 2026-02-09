<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'order_id',
        'is_read',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
