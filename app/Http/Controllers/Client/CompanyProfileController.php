<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
    /**
     * Display the client homepage.
     *
     * Responsibilities:
     * - Retrieve the company profile data (single-record setup)
     * - Render the client home page
     */
    public function index()
    {
        return view('pages.client.home.index', [
            'companyProfile' => CompanyProfile::first(),
        ]);
    }

    /**
     * Display the "About Us" page.
     *
     * Responsibilities:
     * - Retrieve the company profile data
     * - Render the client about page
     */
    public function about()
    {
        return view('pages.client.about.index', [
            'companyProfile' => CompanyProfile::first(),
        ]);
    }

    /**
     * Display the "Vision & Mission" page.
     *
     * Responsibilities:
     * - Retrieve the company profile data
     * - Render the client vision and mission page
     */
    // public function visionMission()
    // {
    //     return view('pages.client.vision-mission.index', [
    //         'companyProfile' => CompanyProfile::first(),
    //     ]);
    // }
}
