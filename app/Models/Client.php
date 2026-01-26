<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'website',
        'description',
        'order',
        'is_active',
    ];

    protected $casts = [
        'order'     => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to retrieve only active clients.
     * Ensures that inactive clients are hidden
     * from public-facing pages.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
