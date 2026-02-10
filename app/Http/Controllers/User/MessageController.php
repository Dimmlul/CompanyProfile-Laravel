<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display the user's message inbox.
     *
     * Responsibilities:
     * - Retrieve root message threads belonging to the authenticated user
     * - Exclude reply messages (parent_id must be null)
     * - Count unread admin replies for each message thread
     * - Apply pagination
     * - Render the user messages index page
     */
    public function index()
    {
        return view('pages.user.messages.index', [
            'messages' => Message::where('user_id', Auth::id())
                ->whereNull('parent_id') // Root threads only
                ->withCount([
                    /**
                     * Count unread replies sent by administrators.
                     */
                    'replies as unread_replies' => function ($q) {
                        $q->where('sender', 'admin')
                          ->where('is_read', false);
                    }
                ])
                ->latest()
                ->paginate(10),
        ]);
    }

    /**
     * Display a single user message thread.
     *
     * Responsibilities:
     * - Ensure the message belongs to the authenticated user
     * - Mark unread admin replies as read
     * - Load the message thread and its replies
     * - Render the user message detail page
     */
    public function show(Message $message)
    {
        /**
         * Prevent users from accessing other users' message threads.
         */
        abort_if($message->user_id !== Auth::id(), 403);

        /**
         * Mark all unread admin replies in this thread as read.
         */
        Message::where('parent_id', $message->id)
            ->where('sender', 'admin')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('pages.user.messages.show', [
            'message' => $message,
            'replies' => $message->replies,
        ]);
    }

    /**
     * Submit a reply to a message thread.
     *
     * Responsibilities:
     * - Ensure the message belongs to the authenticated user
     * - Validate reply input (message and/or attachment)
     * - Handle optional file uploads
     * - Attach the reply to the existing message thread
     * - Persist the reply to the database
     */
    public function reply(Request $request, Message $message)
    {
        /**
         * Prevent users from replying to message threads
         * that do not belong to them.
         */
        abort_if($message->user_id !== Auth::id(), 403);

        $request->validate([
            'message' => 'nullable|string|max:3000',
            'file'    => 'nullable|file|max:5120', // 5MB maximum
        ]);

        $path = null;
        $type = null;

        /**
         * Handle optional file attachment upload.
         * Determine whether the attachment is an image or a generic file.
         */
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('messages', 'public');
            $type = str_contains($request->file('file')->getMimeType(), 'image')
                ? 'image'
                : 'file';
        }

        /**
         * Create a user reply attached to the existing message thread.
         */
        Message::create([
            'parent_id'        => $message->id,
            'sender'           => 'user',
            'user_id'          => Auth::id(),
            'message'          => $request->message,
            'attachment'       => $path,
            'attachment_type'  => $type,
            'is_read'          => false,
        ]);

        return back()->with('success', 'Reply sent.');
    }
}
