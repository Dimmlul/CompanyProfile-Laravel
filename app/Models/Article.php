<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'author',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Use slug instead of id for route model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

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
        static::creating(function ($article) {
            $article->slug = static::generateUniqueSlug($article->title);

            if (empty($article->excerpt)) {
                $article->excerpt = Str::limit(
                    strip_tags($article->content),
                    150
                );
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title')) {
                $article->slug = static::generateUniqueSlug(
                    $article->title,
                    $article->id
                );
            }
        });
    }

    /**
     * Scope: published articles.
     */
    public function scopePublished($query)
    {
        return $query
            ->where('is_published', true)
            ->whereNotNull('published_at');
    }
}
