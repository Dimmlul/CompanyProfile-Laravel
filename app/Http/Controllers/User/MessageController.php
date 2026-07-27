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
            'file'    => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,pdf,doc,docx,xls,xlsx,zip|max:5120', // 5MB, safe types only
        ]);

        /**
         * Safety check:
         * A reply must contain either a text message or a file attachment.
         */
        if (! $request->filled('message') && ! $request->hasFile('file')) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Type a message or attach a file.'], 422);
            }

            return back()->withErrors(['message' => 'Message or file required']);
        }

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
        $reply = Message::create([
            'parent_id'        => $message->id,
            'sender'           => 'user',
            'user_id'          => Auth::id(),
            'message'          => $request->message,
            'attachment'       => $path,
            'attachment_type'  => $type,
            'is_read'          => false,
        ]);

        /**
         * AJAX requests get back the rendered bubble HTML so the thread can
         * be updated in place, without a full page reload.
         */
        if ($request->expectsJson()) {
            return response()->json([
                'html' => view('components.chat-bubble', [
                    'own'            => true,
                    'name'           => 'You',
                    'time'           => $reply->created_at->format('d M, H:i'),
                    'message'        => $reply->message,
                    'attachment'     => $reply->attachment,
                    'attachmentType' => $reply->attachment_type,
                ])->render(),
            ]);
        }

        return back()->with('success', 'Reply sent.');
    }
}
