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
     * Auth user → save to DB
     * Guest → EmailJS (frontend)
     */
public function send(Request $request)
{
    $rules = [
        'from_name'  => 'required|string|max:255',
        'from_email' => 'required|email|max:255',
        'message'    => 'required|string|max:3000',
    ];

    if (Auth::check()) {
        $rules['subject'] = 'required|string|max:255';
    }

    $data = $request->validate($rules);

    if (Auth::check()) {
        Message::create([
            'parent_id' => null,          // 🔑 THREAD BARU
            'sender'    => 'user',
            'user_id'   => Auth::id(),
            'subject'   => $data['subject'],
            'message'   => $data['message'],
            'is_read'   => false,          // BELUM DIBACA ADMIN
        ]);

        return response()->json([
            'status' => 'saved',
            'message' => 'Message sent to admin.',
        ]);
    }

    return response()->json(['status' => 'guest']);
}



}
