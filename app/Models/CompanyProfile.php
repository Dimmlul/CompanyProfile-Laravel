<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * These fields represent the company's public profile information
     * and can be safely filled using create() or update().
     *
     * Typical use cases:
     * - Displaying company information on public pages
     * - Managing company profile settings from the admin panel
     */
    protected $fillable = [
        'company_name',
        'logo',
        'about',
        'vision',
        'mission',
        'address',
        'phone',
        'whatsapp',
        'instagram',
        'fax',
        'email',
    ];
}
