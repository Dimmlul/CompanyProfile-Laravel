<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'delivery_type',
        'download_path',
        'download_url',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price'     => 'decimal:2',
        'order'     => 'integer',
    ];

    /**
     * Route binding via slug
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Helpers
     */
    public function isFile(): bool
    {
        return $this->delivery_type === 'file';
    }

    public function isLink(): bool
    {
        return $this->delivery_type === 'link';
    }

    /**
     * Slug generator
     */
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = static::generateUniqueSlug($product->name);
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = static::generateUniqueSlug(
                    $product->name,
                    $product->id
                );
            }
        });
    }

    private static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $counter = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }
}
