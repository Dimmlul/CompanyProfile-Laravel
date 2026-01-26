<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'location',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'is_active'  => 'boolean',
    ];

    /**
     * Handle automatic slug creation for events.
     * Slugs allow events to be accessed via readable URLs.
     */
    protected static function booted()
    {
        /**
         * Create slug when a new event is stored.
         */
        static::creating(function ($event) {
            $event->slug = Str::slug($event->title);
        });

        /**
         * Update slug only if the event title changes.
         */
        static::updating(function ($event) {
            if ($event->isDirty('title')) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    /**
     * Scope to retrieve only active events.
     * Keeps event visibility logic centralized.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
