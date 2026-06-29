<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
    /**
     * Display the public "About Us" page.
     */
    public function about()
    {
        return view('pages.client.about.index', [
            'companyProfile' => CompanyProfile::first(),
        ]);
    }
}
