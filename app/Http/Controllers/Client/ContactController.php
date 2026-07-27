<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     *
     * Note: $companyProfile isn't fetched here — it's shared globally to every
     * view by AppServiceProvider, with a safe empty-instance fallback. (This
     * used to firstOrFail(), which 404'd the whole contact page if the
     * company_profiles table was ever empty.)
     */
    public function contact()
    {
        return view('pages.client.contact.index');
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
         * Persist the contact message as a new guest thread so it shows up in
         * the admin inbox like any other conversation.
         *
         * Field names must match Message::$fillable (client_name/client_email,
         * not name/email) and 'sender' is a required, non-nullable enum column
         * — omitting either previously meant this either silently dropped the
         * sender's contact info or failed outright with a SQL error.
         */
        Message::create([
            'sender'       => 'client',
            'client_name'  => $data['from_name'],
            'client_email' => $data['from_email'],
            'subject'      => $data['subject'] ?: 'No Subject',
            'message'      => $data['message'],
            'is_read'      => false,
        ]);

        return response()->json([
            'status'  => 'ok',
            'message' => 'Message saved successfully.',
        ]);
    }
}
