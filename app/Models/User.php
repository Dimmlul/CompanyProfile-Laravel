<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * These fields can be safely filled using create() or update().
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /* ======================
     | RELATIONSHIPS
     ====================== */

    /**
     * Get all cart items belonging to the user.
     *
     * Relationship:
     * - A user can have many cart items
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get all orders placed by the user.
     *
     * Relationship:
     * - A user can have many orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all articles authored by the user.
     *
     * Relationship:
     * - A user can have many articles
     * - Uses author_id as the foreign key
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    /* ======================
     | ROLE HELPERS
     ====================== */

    /**
     * Determine whether the user has admin privileges.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Determine whether the user is a regular user.
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /* ======================
     | AUTH SERIALIZATION
     ====================== */

    /**
     * The attributes that should be hidden during serialization.
     *
     * These fields will not be included in arrays or JSON output.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be type cast.
     *
     * - email_verified_at is cast to datetime
     * - password is automatically hashed
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
