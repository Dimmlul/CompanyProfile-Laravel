<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * ======================
     * ADMIN INBOX
     * ======================
     */
    public function index()
    {
        return view('pages.admin.messages.index', [
            'messages' => Message::whereNull('parent_id')
                ->withCount([
                    // unread dari USER (login)
                    'replies as unread_user_replies' => function ($q) {
                        $q->where('sender', 'user')
                          ->where('is_read', false);
                    },
                    // unread dari CLIENT (guest)
                    'replies as unread_client_replies' => function ($q) {
                        $q->where('sender', 'client')
                          ->where('is_read', false);
                    },
                ])
                ->latest()
                ->paginate(15),
        ]);
    }

    /**
     * ======================
     * SHOW THREAD
     * ======================
     */
    public function show(Message $message)
    {
        /**
         * tandai semua reply NON-admin sebagai read
         * (baik user maupun client)
         */
        Message::where('parent_id', $message->id)
            ->whereIn('sender', ['user', 'client'])
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('pages.admin.messages.show', [
            'message' => $message,
            'replies' => $message->replies, // ⬅️ PENTING: ini SATU-SATUNYA sumber $reply
        ]);
    }

    /**
     * ======================
     * ADMIN REPLY
     * ======================
     */
    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'message' => 'nullable|string|max:3000',
            'file'    => 'nullable|file|max:5120', // 5MB
        ]);

        /**
         * SAFETY: message ATAU file harus ada
         */
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

        /**
         * ADMIN REPLY
         * - tetap ikuti konteks thread (user / client)
         */
        Message::create([
            'parent_id'       => $message->id,
            'sender'          => 'admin',

            // USER (kalau thread dari user)
            'user_id'         => $message->user_id,

            // CLIENT (kalau thread dari guest)
            'client_token'    => $message->client_token,
            'client_name'     => $message->client_name,
            'client_email'    => $message->client_email,

            'subject'         => $message->subject,
            'message'         => $request->message ?? '[Attachment]',
            'attachment'      => $path,
            'attachment_type' => $type,
            'is_read'         => false,
        ]);

        return back()->with('success', 'Reply sent.');
    }
}
