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
     *
     * Display the admin inbox.
     *
     * Responsibilities:
     * - Retrieve root messages (parent threads only)
     * - Count unread replies from authenticated users
     * - Count unread replies from guest clients
     * - Paginate results for the inbox view
     */
    public function index()
    {
        return view('pages.admin.messages.index', [
            'messages' => Message::whereNull('parent_id')
                ->withCount([
                    /**
                     * Count unread replies sent by authenticated users.
                     */
                    'replies as unread_user_replies' => function ($q) {
                        $q->where('sender', 'user')
                          ->where('is_read', false);
                    },

                    /**
                     * Count unread replies sent by guest clients.
                     */
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
     * SHOW MESSAGE THREAD
     * ======================
     *
     * Display a full message thread.
     *
     * Responsibilities:
     * - Mark all unread non-admin replies as read
     *   (both authenticated users and guest clients)
     * - Load the parent message and its replies
     * - Render the admin message thread view
     */
    public function show(Message $message)
    {
        /**
         * Mark all unread replies from non-admin senders as read.
         * This includes both user and client replies.
         */
        Message::where('parent_id', $message->id)
            ->whereIn('sender', ['user', 'client'])
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('pages.admin.messages.show', [
            'message' => $message,

            /**
             * IMPORTANT:
             * This is the single source of truth for all replies
             * belonging to the current message thread.
             */
            'replies' => $message->replies,
        ]);
    }

    /**
     * ======================
     * ADMIN REPLY
     * ======================
     *
     * Handle admin replies to a message thread.
     *
     * Responsibilities:
     * - Validate reply input (message and/or attachment)
     * - Prevent empty replies (no message and no file)
     * - Handle optional file upload
     * - Preserve original thread context (user or guest client)
     * - Persist the admin reply to the database
     */
    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'message' => 'nullable|string|max:3000',
            'file'    => 'nullable|file|max:5120', // 5MB max
        ]);

        /**
         * Safety check:
         * A reply must contain either a text message or a file attachment.
         */
        if (! $request->filled('message') && ! $request->hasFile('file')) {
            return back()
                ->withErrors(['message' => 'Message or file is required.'])
                ->withInput();
        }

        $path = null;
        $type = null;

        /**
         * Handle file attachment upload.
         * Determine attachment type (image or generic file).
         */
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('messages', 'public');

            $type = str_contains($file->getMimeType(), 'image')
                ? 'image'
                : 'file';
        }

        /**
         * Create an admin reply.
         *
         * Notes:
         * - The reply always belongs to an existing thread
         * - User or client context is preserved from the parent message
         */
        Message::create([
            'parent_id'       => $message->id,
            'sender'          => 'admin',

            // User context (if the thread belongs to a registered user)
            'user_id'         => $message->user_id,

            // Guest client context (if the thread belongs to a guest)
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
