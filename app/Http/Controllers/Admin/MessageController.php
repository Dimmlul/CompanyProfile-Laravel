<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * ADMIN INBOX
     */
    public function index()
    {
        return view('pages.admin.messages.index', [
            'messages' => Message::whereNull('parent_id')
                ->with('user')
                ->withCount([
                    'replies as unread_replies' => function ($q) {
                        $q->where('sender', 'user')
                          ->where('is_read', false);
                    }
                ])
                ->latest()
                ->paginate(15),
        ]);
    }

    /**
     * SHOW THREAD
     */
    public function show(Message $message)
    {
        // mark USER replies as read
        Message::where('parent_id', $message->id)
            ->where('sender', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('pages.admin.messages.show', [
            'message' => $message,
            'replies' => $message->replies,
        ]);
    }

    /**
     * ADMIN REPLY
     */
public function reply(Request $request, Message $message)
{
    $request->validate([
        'message' => 'nullable|string|max:3000',
        'file'    => 'nullable|file|max:5120', // 5MB
    ]);

    // ❗ SAFETY CHECK: minimal salah satu harus ada
    if (! $request->filled('message') && ! $request->hasFile('file')) {
        return back()
            ->withErrors(['message' => 'Message or file is required.'])
            ->withInput();
    }

    $path = null;
    $type = null;

    if ($request->hasFile('file')) {
        $file = $request->file('file');

        $path = $file->store('messages', 'public');

        $type = str_contains($file->getMimeType(), 'image')
            ? 'image'
            : 'file';
    }

    Message::create([
        'parent_id'       => $message->id,
        'sender'          => 'admin',
        'user_id'         => $message->user_id,
        'subject'         => $message->subject,
        'message'         => $request->message ?? '[Attachment]',
        'attachment'      => $path,
        'attachment_type' => $type,
        'is_read'         => false,
    ]);

    return back()->with('success', 'Reply sent.');
}

}
