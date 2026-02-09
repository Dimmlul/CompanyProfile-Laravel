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
            'messages' => Message::where('user_id', Auth::user()->id)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function show(Message $message)
    {
        abort_if($message->user_id !== Auth::user()->id, 403);

        $message->update(['is_read' => true]);

        return view('pages.user.messages.show', [
            'message' => $message,
            'replies' => $message->replies,
        ]);
    }


}
