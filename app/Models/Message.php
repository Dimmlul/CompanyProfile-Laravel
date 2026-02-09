<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'parent_id',
        'sender',
        'user_id',
        'subject',
        'message',
        'order_id',
        'attachment',
        'attachment_type',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // ========================
    // RELATIONSHIPS
    // ========================

    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id')->oldest();
    }

    public function parent()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
