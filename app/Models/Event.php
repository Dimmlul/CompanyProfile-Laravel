<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
     * Generate unique slug.
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
     * Model events.
     */
    protected static function booted()
    {
        static::creating(function ($event) {
            $event->slug = static::generateUniqueSlug($event->title);
        });

        static::updating(function ($event) {
            if ($event->isDirty('title')) {
                $event->slug = static::generateUniqueSlug(
                    $event->title,
                    $event->id
                );
            }
        });
    }

    /**
     * Scope: active events.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
