<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * These fields define the core product data, pricing,
     * delivery configuration, and visibility state.
     */
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

    /**
     * Attribute casting configuration.
     *
     * - is_active is cast to boolean for visibility control
     * - price is cast to decimal with 2 decimal places for accuracy
     * - order is cast to integer for proper sorting
     */
    protected $casts = [
        'is_active' => 'boolean',
        'price'     => 'decimal:2',
        'order'     => 'integer',
    ];

    /**
     * Use the product slug instead of the ID for route model binding.
     *
     * This allows URLs such as:
     * /products/my-product-name
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Order items that reference this product (used to protect purchase history on delete).
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /* =====================
     | HELPER METHODS
     ===================== */

    /**
     * Determine whether the product uses file-based delivery.
     */
    public function isFile(): bool
    {
        return $this->delivery_type === 'file';
    }

    /**
     * Determine whether the product uses link-based delivery.
     */
    public function isLink(): bool
    {
        return $this->delivery_type === 'link';
    }

    /* =====================
     | MODEL EVENTS
     ===================== */

    /**
     * Register model lifecycle hooks.
     *
     * Events handled:
     * - creating: automatically generate a unique slug
     * - updating: regenerate the slug if the product name changes
     */
    protected static function booted()
    {
        static::creating(function ($product) {
            /**
             * Generate a unique slug when creating a new product.
             */
            $product->slug = static::generateUniqueSlug($product->name);
        });

        static::updating(function ($product) {
            /**
             * Regenerate the slug only if the product name has changed.
             */
            if ($product->isDirty('name')) {
                $product->slug = static::generateUniqueSlug(
                    $product->name,
                    $product->id
                );
            }
        });
    }

    /**
     * Generate a unique slug based on the product name.
     *
     * Responsibilities:
     * - Convert the name into a URL-friendly slug
     * - Ensure slug uniqueness in the database
     * - Append an incremental suffix if a duplicate exists
     *
     * @param string   $name      The product name
     * @param int|null $ignoreId  Optional product ID to exclude (used on update)
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
            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }
}
