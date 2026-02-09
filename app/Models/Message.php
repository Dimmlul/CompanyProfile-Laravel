<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'reply',
        'replied_at',
        'order_id',
        'is_read',
    ];

    protected $casts = [
        'is_read'    => 'boolean',
        'replied_at' => 'datetime',
    ];

    // ========================
    // RELATIONS
    // ========================


    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id')->latest();
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

    // ========================
    // HELPERS
    // ========================

    public function hasReply(): bool
    {
        return ! is_null($this->reply);
    }
}
