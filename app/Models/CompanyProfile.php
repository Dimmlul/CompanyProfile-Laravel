<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;

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
        'fax',
        'email'
    ];



}

    