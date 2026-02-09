<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        return view('pages.admin.messages.index', [
            'messages' => Message::latest()->paginate(15),
        ]);
    }

    public function show(Message $message)
    {
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('pages.admin.messages.show', compact('message'));
    }
}
