<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;
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
     * The booted method listens to model lifecycle events.
     * It is used here to automatically manage slug and excerpt
     * without placing logic inside controllers.
     */
    protected static function booted()
    {
        /**
         * This event runs when a new article is being created.
         * - Generates a URL-friendly slug from the article title.
         * - Automatically creates an excerpt if it is not provided.
         */
        static::creating(function ($article) {
            $article->slug = Str::slug($article->title);

            if (empty($article->excerpt)) {
                $article->excerpt = Str::limit(
                    strip_tags($article->content),
                    150
                );
            }
        });

        /**
         * This event runs when an existing article is being updated.
         * The slug is regenerated only if the title has changed,
         * ensuring stable URLs and preventing unnecessary slug updates.
         */
        static::updating(function ($article) {
            if ($article->isDirty('title')) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    /**
     * Scope to retrieve only published articles.
     * This keeps query logic consistent and reusable
     * across controllers and other parts of the application.
     */
    public function scopePublished($query)
    {
        return $query
            ->where('is_published', true)
            ->whereNotNull('published_at');
    }
}
