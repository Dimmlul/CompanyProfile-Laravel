<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    /**
     * Inbox admin
     */
    public function index()
    {
        return view('pages.admin.messages.index', [
            'messages' => Message::latest()->paginate(15),
        ]);
    }

    /**
     * Detail message
     */
    public function show(Message $message)
    {
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('pages.admin.messages.show', compact('message'));
    }

    /**
     * Mark as read (AJAX / optional)
     */
    public function markAsRead(Message $message)
    {
        $message->update(['is_read' => true]);

        return back();
    }

    /**
     * Reply message
     */
    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'reply' => ['required', 'string'],
        ]);

        // 🔹 KIRIM EMAIL KE USER
        Mail::raw($request->reply, function ($mail) use ($message) {
            $mail->to($message->email)
                 ->subject('Reply: ' . ($message->subject ?? 'Your Message'));
        });

        return back()->with('success', 'Reply sent to user.');
    }
}
