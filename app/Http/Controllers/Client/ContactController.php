<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Contact page
     */
    public function contact()
    {
       $companyProfile = CompanyProfile::query()->firstOrFail();

        return view('pages.client.contact.index', compact('companyProfile'));
    }

    /**
     * Handle contact form
     * - Simpan ke DB
     * - Bisa guest
     */
    public function send(Request $request)
    {
        $data = $request->validate([
            'from_name'  => 'required|string|max:255',
            'from_email' => 'required|email|max:255',
            'subject'    => 'nullable|string|max:255',
            'message'    => 'required|string|max:3000',
        ]);

        Message::create([
            'name'    => $data['from_name'],
            'email'   => $data['from_email'],
            'subject' => $data['subject'] ?: 'No Subject',
            'message' => $data['message'],
            'is_read' => false,
        ]);

        return response()->json([
            'status'  => 'ok',
            'message' => 'Message saved successfully.',
        ]);
    }
}
