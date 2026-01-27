<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function index()
{
    return view('pages.client.home.index', [
        'companyProfile' => CompanyProfile::first(),
    ]);
}
}
