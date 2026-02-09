<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;


class MessageController extends Controller
{
    /**
     * List messages sent by logged-in user
     */
    public function index()
    {
        return view('pages.user.messages.index', [
            'messages' => Message::where('email', auth('web')->user()->email)
                ->latest()
                ->paginate(10),
        ]);
    }

    /**
     * Show message detail
     */
    public function show(Message $message)
    {
        // security: user only sees their own message
        abort_if(
            $message->email !== auth('web')->user()->email,
            403
        );

        return view(
            'pages.user.messages.show',
            compact('message')
        );
    }
}
