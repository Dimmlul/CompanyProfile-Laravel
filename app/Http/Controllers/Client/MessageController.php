<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    // START PAGE
    public function create()
    {
        return view('pages.client.messages.start');
    }

    // CREATE THREAD
public function store(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:100',
        'email'   => 'required|email|max:255',
        'message' => 'required|string|max:3000',
    ]);

    $token = Str::uuid()->toString();

    Message::create([
        'sender'       => 'client',
        'client_token' => $token,
        'client_name'  => $request->name,
        'client_email' => $request->email,
        'message'      => $request->message,
        'is_read'      => false,
    ]);

    // 🔑 SIMPAN TOKEN
    cookie()->queue(
        cookie('support_chat_token', $token, 60 * 24 * 30)
    );

    return redirect()->route('client.messages.show', $token);
}



    // SHOW THREAD
public function show(string $token)
{
    $message = Message::where('client_token', $token)
        ->whereNull('parent_id')
        ->first();

    // ❗ kalau token tidak valid → redirect, BUKAN 403
    if (! $message) {
        return redirect()
            ->route('client.messages.start')
            ->with('error', 'Chat session not found.');
    }

    // ⬅️ simpan token lagi (biar awet)
    cookie()->queue(
        cookie('support_chat_token', $token, 60 * 24 * 30)
    );

    // mark admin replies as read
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



    // CLIENT REPLY
    public function reply(Request $request, string $token)
    {
        $request->validate([
            'message' => 'nullable|string|max:3000',
            'file'    => 'nullable|file|max:5120',
        ]);

        if (! $request->filled('message') && ! $request->hasFile('file')) {
            return back()->withErrors(['message' => 'Message or file required']);
        }

        $root = Message::where('client_token', $token)
            ->whereNull('parent_id')
            ->firstOrFail();

        $path = null;
        $type = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('messages', 'public');
            $type = str_contains($file->getMimeType(), 'image') ? 'image' : 'file';
        }

        Message::create([
            'parent_id'       => $root->id,
            'sender'          => 'client',
            'client_token'    => $root->client_token,
            'client_name'     => $root->client_name,
            'client_email'    => $root->client_email,
            'message'         => $request->message ?? '[Attachment]',
            'attachment'      => $path,
            'attachment_type' => $type,
        ]);

        return back();
    }
}
