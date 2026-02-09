<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'parent_id',
        'sender',
        'user_id',
        'client_token',
        'client_name',
        'client_email',
        'subject',
        'message',
        'attachment',
        'attachment_type',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /* =====================
     | RELATIONS
     ===================== */
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

    /* =====================
     | HELPERS
     ===================== */
    public function isClient(): bool
    {
        return ! is_null($this->client_token);
    }

    public function displayName(): string
    {
        return match ($this->sender) {
            'admin'  => 'Admin',
            'user'   => $this->user?->name ?? 'User',
            'client' => $this->client_name ?? 'Client',
        };
    }
}
