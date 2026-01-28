<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.client.contact.index');
    }
}
