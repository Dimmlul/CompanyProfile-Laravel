<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'from_name'  => 'required|string|max:255',
            'from_email' => 'required|email|max:255',
            'message'    => 'required|string|max:3000',
        ]);

        if (Auth::check()) {
            Message::create([
                'name'    => $data['from_name'],
                'email'   => $data['from_email'],
                'message' => $data['message'],
                'is_read' => false,
            ]);

            return response()->json([
                'type'    => 'saved',
                'message' => 'Message sent successfully.',
            ]);
        }

        // ✅ GUEST → EMAILJS (handled by frontend)
        return response()->json([
            'type' => 'email',
        ]);
    }
}
