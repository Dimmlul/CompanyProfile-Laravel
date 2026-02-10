<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * These fields can be safely filled using create() or update()
     * operations from controllers or seeders.
     */
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

    /**
     * Attribute casting configuration.
     *
     * - start_date and end_date are cast to datetime instances
     * - is_active is cast to boolean for status checks
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'is_active'  => 'boolean',
    ];

    /**
     * Use the article slug instead of the ID for route model binding.
     *
     * This allows URLs like:
     * /articles/my-article-title
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    // } !!!!!!!!!!!!!!!!

    /**
     * Generate a unique slug based on the event title.
     *
     * Responsibilities:
     * - Convert the title into a URL-friendly slug
     * - Ensure slug uniqueness across the events table
     * - Append an incremental suffix if a duplicate slug exists
     *
     * @param string   $title     The event title
     * @param int|null $ignoreId  Optional event ID to exclude (used on update)
     */
    private static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $counter = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $counter++;
            $slug = $original . '-' . $counter;
        }

        return $slug;
    }

    /**
     * Register model lifecycle event hooks.
     *
     * Events handled:
     * - creating: automatically generate a unique slug
     * - updating: regenerate the slug if the title has changed
     */
    protected static function booted()
    {
        static::creating(function ($event) {
            /**
             * Generate a unique slug when creating a new event.
             */
            $event->slug = static::generateUniqueSlug($event->title);
        });

        static::updating(function ($event) {
            /**
             * Regenerate the slug only if the title has been modified.
             */
            if ($event->isDirty('title')) {
                $event->slug = static::generateUniqueSlug(
                    $event->title,
                    $event->id
                );
            }
        });
    }

    /**
     * Query scope: active events.
     *
     * Responsibilities:
     * - Retrieve only events marked as active
     * - Hide inactive events from public-facing pages
     *
     * Usage example:
     * Event::active()->orderBy('start_date')->get();
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
