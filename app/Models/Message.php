<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * These fields support threaded messaging between:
     * - Admin
     * - Authenticated users
     * - Guest clients
     */
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

    /**
     * Attribute casting configuration.
     *
     * - is_read is cast to boolean for read/unread state tracking
     */
    protected $casts = [
        'is_read' => 'boolean',
    ];

    /* =====================
     | RELATIONSHIPS
     ===================== */

    /**
     * Get all replies for this message.
     *
     * Relationship:
     * - A message can have many replies
     * - Replies are ordered from oldest to newest
     */
    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id')->oldest();
    }

    /**
     * Get the most recent reply in this thread (used for inbox previews).
     *
     * Relationship:
     * - Falls back to nothing if the thread has no replies yet,
     *   in which case the caller should preview the root message itself.
     */
    public function latestReply()
    {
        return $this->hasOne(Message::class, 'parent_id')->latestOfMany();
    }

    /**
     * Get the parent message of this reply.
     *
     * Relationship:
     * - A reply belongs to a single parent message
     */
    public function parent()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    /**
     * Get the user associated with this message.
     *
     * Relationship:
     * - Only applicable when the sender is an authenticated user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* =====================
     | HELPER METHODS
     ===================== */

    /**
     * Determine whether the message was sent by a guest client.
     *
     * A message is considered a client message if it has a client token.
     */
    public function isClient(): bool
    {
        return ! is_null($this->client_token);
    }

    /**
     * Get the display name for the message sender.
     *
     * Behavior:
     * - Admin messages display as "Admin"
     * - User messages display the user's name
     * - Client messages display the provided client name
     */
    public function displayName(): string
    {
        return match ($this->sender) {
            'admin'  => 'Admin',
            'user'   => $this->user?->name ?? 'User',
            'client' => $this->client_name ?? 'Client',
        };
    }
}
