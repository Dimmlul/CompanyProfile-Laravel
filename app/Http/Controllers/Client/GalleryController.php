<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display gallery on client side.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('order')->get();

        return view('pages.client.gallery.index', compact('galleries'));
    }
}
