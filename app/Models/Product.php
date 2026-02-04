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
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price'     => 'decimal:2',
        'order'     => 'integer',
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

    /**
     * Scope: active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
