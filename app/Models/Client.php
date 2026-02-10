<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * These fields can be safely filled using create() or update().
     */
    protected $fillable = [
        'name',
        'logo',
        'website',
        'description',
        'order',
        'is_active',
    ];

    /**
     * Attribute casting configuration.
     *
     * - order is cast to integer for proper sorting
     * - is_active is cast to boolean for status checks
     */
    protected $casts = [
        'order'     => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Query scope: active clients.
     *
     * Responsibilities:
     * - Retrieve only clients marked as active
     * - Hide inactive clients from public-facing pages
     * - Simplify reuse across queries
     *
     * Usage example:
     * Client::active()->orderBy('order')->get();
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
