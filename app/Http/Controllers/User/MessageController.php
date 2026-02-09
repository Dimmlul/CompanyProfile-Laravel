<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return view('pages.user.messages.index', [
            'messages' => Message::where('email', Auth::user()->email)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function show(Message $message)
    {
        abort_if(
            $message->email !== Auth::user()->email,
            403
        );

        return view('pages.user.messages.show', compact('message'));
    }
}
