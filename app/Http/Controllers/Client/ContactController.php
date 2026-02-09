<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Handle contact form
     * - Auth user  → save to DB
     * - Guest      → EmailJS (handled in frontend)
     */
    public function send(Request $request)
    {
        $data = $request->validate([
            'from_name'  => 'required|string|max:255',
            'from_email' => 'required|email|max:255',
            'message'    => 'required|string|max:3000',
        ]);

        // ✅ USER LOGIN → SAVE TO DATABASE
        if (Auth::check()) {
            $user = Auth::user();
            Message::create([
                'name'    => $user->name,
                'email'   => $user->email,
                'message' => $data['message'],
                'is_read' => false,
            ]);

            return response()->json([
                'status'  => 'saved',
                'message' => 'Message sent to admin inbox.',
            ]);
        }

        // ✅ GUEST → FRONTEND WILL SEND EMAILJS
        return response()->json([
            'status' => 'guest',
        ]);
    }
}
