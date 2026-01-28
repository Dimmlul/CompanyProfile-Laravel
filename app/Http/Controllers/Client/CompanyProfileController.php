<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
    public function index()
    {
        return view('pages.client.home.index', [
            'companyProfile' => CompanyProfile::first(),
        ]);
    }

    public function about()
    {
        return view('pages.client.about.index', [
            'companyProfile' => CompanyProfile::first(),
        ]);
    }

    public function visionMission()
    {
        return view('pages.client.vision-mission.index', [
            'companyProfile' => CompanyProfile::first(),
        ]);
    }
}
