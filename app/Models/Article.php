<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * These fields can be safely filled using create() or update().
     */
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

    /**
     * Attribute casting configuration.
     *
     * - is_published is cast to boolean
     * - published_at is cast to a Carbon datetime instance
     */
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
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

    /**
     * Generate a unique slug based on the article title.
     *
     * Responsibilities:
     * - Convert the title into a URL-friendly slug
     * - Ensure slug uniqueness in the database
     * - Append an incremental suffix if a duplicate slug exists
     *
     * @param string   $title     The article title
     * @param int|null $ignoreId  Optional article ID to exclude (used on update)
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
     * Register model event hooks.
     *
     * Events handled:
     * - creating: generate slug and auto-generate excerpt if missing
     * - updating: regenerate slug if the title has changed
     */
    protected static function booted()
    {
        static::creating(function ($article) {
            /**
             * Generate a unique slug when creating a new article.
             */
            $article->slug = static::generateUniqueSlug($article->title);

            /**
             * Automatically generate an excerpt if none is provided.
             */
            if (empty($article->excerpt)) {
                $article->excerpt = Str::limit(
                    strip_tags($article->content),
                    150
                );
            }
        });

        static::updating(function ($article) {
            /**
             * Regenerate the slug only if the title has changed.
             */
            if ($article->isDirty('title')) {
                $article->slug = static::generateUniqueSlug(
                    $article->title,
                    $article->id
                );
            }
        });
    }

    /**
     * Query scope: published articles.
     *
     * Returns only articles that:
     * - Are marked as published
     * - Have a published_at timestamp
     */
    public function scopePublished($query)
    {
        return $query
            ->where('is_published', true)
            ->whereNotNull('published_at');
    }
}
