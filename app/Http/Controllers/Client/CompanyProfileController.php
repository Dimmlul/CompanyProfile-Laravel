<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class CompanyProfileController extends Controller
{
    /**
     * Display the public "About Us" page.
     *
     * Note: $companyProfile isn't fetched here — it's shared globally to every
     * view by AppServiceProvider, with a safe empty-instance fallback.
     */
    public function about()
    {
        // Use a real gallery photo for the hero instead of the static placeholder.
        $aboutImage = Gallery::where('is_active', true)
            ->orderBy('order')
            ->value('image');

        return view('pages.client.about.index', [
            'aboutImage' => $aboutImage,
        ]);
    }
}
