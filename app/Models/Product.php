<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'image',
        'price',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price'     => 'decimal:2',
        'order'     => 'integer',
    ];

    /**
     * Automatically handle slug generation for products.
     * Slugs are used instead of numeric IDs to create
     * cleaner, more readable, and SEO-friendly URLs.
     */
    protected static function booted()
    {
        /**
         * Generate slug when a product is first created.
         */
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        /**
         * Update slug only when the product name changes.
         * This prevents unnecessary URL changes.
         */
        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Scope to retrieve only active products.
     * Used for public-facing product listings.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
