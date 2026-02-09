<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return view('pages.user.messages.index', [
            'messages' => Message::where('user_id', Auth::id())
                ->whereNull('parent_id') // ⬅️ PENTING
                ->withCount([
                    'replies as unread_replies' => function ($q) {
                        $q->where('sender', 'admin')
                        ->where('is_read', false);
                    }
                ])
                ->latest()
                ->paginate(10),
        ]);
    }


    public function show(Message $message)
    {
        abort_if($message->user_id !== Auth::id(), 403);

        // Tandai reply admin sebagai read
        Message::where('parent_id', $message->id)
            ->where('sender', 'admin')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('pages.user.messages.show', [
            'message' => $message,
            'replies' => $message->replies,
        ]);
    }

    public function reply(Request $request, Message $message)
    {
        abort_if($message->user_id !== Auth::id(), 403);

        $request->validate([
            'message' => 'nullable|string|max:3000',
            'file'    => 'nullable|file|max:5120', // 5MB
        ]);

        $path = null;
        $type = null;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('messages', 'public');
            $type = str_contains($request->file('file')->getMimeType(), 'image')
                ? 'image'
                : 'file';
        }

        Message::create([
            'parent_id' => $message->id,
            'sender'    => 'user',
            'user_id'   => Auth::id(),
            'message'   => $request->message,
            'attachment'=> $path,
            'attachment_type' => $type,
            'is_read'   => false,
        ]);


        return back()->with('success', 'Reply sent.');
    }
}
