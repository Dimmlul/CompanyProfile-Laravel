<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return view('pages.client.messages.index', [
            'messages' => Message::where('email', Auth::user()->email)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function show(Message $message)
    {
        // Security: pastikan message milik user
        abort_if(
            $message->email !== Auth::user()->email,
            403
        );

        return view('pages.client.messages.show', compact('message'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email',
            'phone'   => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'order_id'=> 'nullable|exists:orders,id',
        ]);

        Message::create($validated);

        return back()->with('success', 'Your message has been sent.');
    }
}
