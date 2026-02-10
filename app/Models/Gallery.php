<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    /**
     * The database table associated with the model.
     *
     * Explicitly defined for clarity and consistency.
     */
    protected $table = 'galleries';

    /**
     * The attributes that are mass assignable.
     *
     * These fields can be safely filled using create() or update().
     */
    protected $fillable = [
        'title',
        'image',
        'caption',
        'category',
        'order',
        'is_active',
    ];

    /**
     * Attribute casting configuration.
     *
     * - order is cast to integer for correct sorting
     * - is_active is cast to boolean for visibility control
     */
    protected $casts = [
        'order'     => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Query scope: active gallery items.
     *
     * Responsibilities:
     * - Retrieve only gallery items marked as active
     * - Hide inactive gallery items from public-facing pages
     *
     * Usage example:
     * Gallery::active()->orderBy('order')->get();
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
