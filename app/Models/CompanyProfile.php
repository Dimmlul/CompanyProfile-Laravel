<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyProfile extends Model
{
    use HasFactory;

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
