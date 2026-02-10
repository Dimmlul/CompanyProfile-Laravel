<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display the gallery page on the client side.
     *
     * Responsibilities:
     * - Retrieve gallery items ordered by the custom `order` column
     * - Provide all gallery data without pagination
     * - Render the client gallery page
     */
    public function index()
    {
        $galleries = Gallery::orderBy('order')->get();

        return view('pages.client.gallery.index', compact('galleries'));
    }
}
