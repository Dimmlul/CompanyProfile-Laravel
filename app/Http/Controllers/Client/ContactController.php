<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     *
     * Responsibilities:
     * - Retrieve the company profile data (single-record setup)
     * - Render the client contact page
     */
    public function contact()
    {
        $companyProfile = CompanyProfile::query()->firstOrFail();

        return view('pages.client.contact.index', compact('companyProfile'));
    }

    /**
     * Handle the contact form submission.
     *
     * Responsibilities:
     * - Validate incoming contact form data
     * - Allow submissions from guest users
     * - Store the message in the database
     * - Return a JSON response for frontend handling
     */
    public function send(Request $request)
    {
        $data = $request->validate([
            'from_name'  => 'required|string|max:255',
            'from_email' => 'required|email|max:255',
            'subject'    => 'nullable|string|max:255',
            'message'    => 'required|string|max:3000',
        ]);

        /**
         * Persist the contact message.
         * Messages submitted through this form are treated as unread by default.
         */
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
