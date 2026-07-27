<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    /**
     * Display the starting page for the client message system.
     *
     * Responsibilities:
     * - Render the initial page where a client can start a new message thread
     */
    public function create()
    {
        return view('pages.client.messages.start');
    }

    /**
     * Create a new client message thread.
     *
     * Responsibilities:
     * - Validate incoming client data
     * - Generate a unique client token for the conversation
     * - Create the root message for the thread
     * - Persist the client token in a long-lived cookie
     * - Redirect the client to the message thread view
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:3000',
        ]);

        /**
         * Generate a unique token to identify the client conversation.
         */
        $token = Str::uuid()->toString();

        /**
         * Create the root message for the client thread.
         * When the visitor is logged in, link the thread to their account
         * so it also appears in their Messages history.
         */
        $message = Message::create([
            'sender'       => 'client',
            'user_id'      => auth()->id(),
            'client_token' => $token,
            'client_name'  => $request->name,
            'client_email' => $request->email,
            'subject'      => 'Support chat',
            'message'      => $request->message,
            'is_read'      => false,
        ]);

        /**
         * Persist the client token in a cookie to maintain session continuity.
         * The cookie is stored for 30 days.
         */
        cookie()->queue(
            cookie('support_chat_token', $token, 60 * 24 * 30)
        );

        /**
         * Logged-in users continue inside their Messages history;
         * guests use the token-based thread view.
         */
        if (auth()->check()) {
            return redirect()->route('user.messages.show', $message);
        }

        return redirect()->route('client.messages.show', $token);
    }

    /**
     * Display a client message thread.
     *
     * Responsibilities:
     * - Retrieve the root message using the client token
     * - Gracefully handle invalid or expired tokens
     * - Refresh the client token cookie for session continuity
     * - Mark unread admin replies as read
     * - Render the client message thread view
     */
    public function show(string $token)
    {
        $message = Message::where('client_token', $token)
            ->whereNull('parent_id')
            ->first();

        /**
         * If the token is invalid, redirect the client back to the start page.
         * A redirect is used instead of a 403 to provide a better user experience.
         */
        if (! $message) {
            return redirect()
                ->route('client.messages.start')
                ->with('error', 'Chat session not found.');
        }

        /**
         * Refresh the client token cookie to extend its validity.
         */
        cookie()->queue(
            cookie('support_chat_token', $token, 60 * 24 * 30)
        );

        /**
         * Mark all unread admin replies in this thread as read.
         */
        Message::where('parent_id', $message->id)
            ->where('sender', 'admin')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('pages.client.messages.show', [
            'message' => $message,
            'replies' => $message->replies,
            'token'   => $token,
        ]);
    }

    /**
     * Submit a client reply to an existing message thread.
     *
     * Responsibilities:
     * - Validate reply input (message and/or attachment)
     * - Ensure the reply contains content or a file
     * - Attach the reply to the existing client thread
     * - Handle optional file uploads
     * - Persist the reply to the database
     */
    public function reply(Request $request, string $token)
    {
        $request->validate([
            'message' => 'nullable|string|max:3000',
            'file'    => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,pdf,doc,docx,xls,xlsx,zip|max:5120',
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

        /**
         * Retrieve the root message for the client thread.
         */
        $root = Message::where('client_token', $token)
            ->whereNull('parent_id')
            ->firstOrFail();

        $path = null;
        $type = null;

        /**
         * Handle optional file attachment upload.
         * Determine whether the attachment is an image or a generic file.
         */
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('messages', 'public');
            $type = str_contains($file->getMimeType(), 'image') ? 'image' : 'file';
        }

        /**
         * Create the client reply and attach it to the existing thread.
         */
        $reply = Message::create([
            'parent_id'       => $root->id,
            'sender'          => 'client',
            'user_id'         => $root->user_id,
            'client_token'    => $root->client_token,
            'client_name'     => $root->client_name,
            'client_email'    => $root->client_email,
            'message'         => $request->message ?? '[Attachment]',
            'attachment'      => $path,
            'attachment_type' => $type,
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

        return back();
    }
}
