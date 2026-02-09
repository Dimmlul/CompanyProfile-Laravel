@extends('layouts.admin')

@section('title', 'Message Detail')

@section('content')
<div class="space-y-6 max-w-3xl">

    <a href="{{ route('admin.messages.index') }}"
       class="text-sm text-indigo-400 hover:underline">
        ← Back to inbox
    </a>

    <div class="client-card p-6 space-y-4">
        <h2 class="text-lg font-semibold text-white">
            {{ $message->subject ?? 'Message' }}
        </h2>

        <p class="text-sm text-app-muted">
            From: {{ $message->name }} ({{ $message->email }})
        </p>

        <div class="mt-4 text-white text-sm leading-relaxed">
            {{ $message->message }}
        </div>
    </div>

    {{-- REPLY --}}
    <div class="client-card p-6">
        <h3 class="text-sm font-semibold mb-3 text-white">
            Reply to message
        </h3>

        <form method="POST"
              action="{{ route('admin.messages.reply', $message) }}">
            @csrf

            <textarea
                name="reply"
                rows="4"
                required
                class="client-input w-full rounded-lg px-4 py-3 text-sm"
                placeholder="Type your reply..."
            ></textarea>

            <button
                class="mt-4 rounded-lg bg-indigo-500 px-6 py-2
                       text-sm font-semibold text-white hover:bg-indigo-600">
                Send Reply
            </button>
        </form>
    </div>
</div>
@endsection
