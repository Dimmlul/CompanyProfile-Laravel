@extends('layouts.admin')

@section('title', 'Message Detail')

@section('content')
<div class="max-w-4xl space-y-8">

    {{-- BACK --}}
    <a
        href="{{ route('admin.messages.index') }}"
        class="inline-flex items-center gap-2
               text-sm text-app-muted
               hover:text-indigo-400 transition"
    >
        ← Back to inbox
    </a>

    {{-- MESSAGE --}}
    <div
        class="rounded-2xl border border-white/10
               bg-white/5 backdrop-blur
               p-8 space-y-6"
    >
        <div>
            <h1 class="text-xl font-semibold text-white">
                {{ $message->subject ?? 'Message' }}
            </h1>

            <p class="mt-2 text-sm text-app-muted">
                From {{ $message->user?->name }} •
                {{ $message->created_at->format('d M Y, H:i') }}
            </p>
        </div>

        <div class="whitespace-pre-line text-sm text-white/90 leading-relaxed">
            {{ $message->message }}
        </div>
    </div>

    {{-- REPLY --}}
    <div
        class="rounded-2xl border border-white/10
               bg-white/5 backdrop-blur
               p-8"
    >
        <h3 class="mb-4 text-sm font-semibold text-white">
            Reply to user
        </h3>

        <form
            method="POST"
            action="{{ route('admin.messages.reply', $message) }}"
            class="space-y-4"
        >
            @csrf

            <textarea
                name="reply"
                rows="4"
                required
                class="client-input w-full rounded-xl px-4 py-3 text-sm"
                placeholder="Type your reply here..."
            ></textarea>

            <div class="flex justify-end">
                <button
                    class="inline-flex items-center gap-2
                           rounded-xl bg-indigo-500 px-6 py-2.5
                           text-sm font-semibold text-white
                           hover:bg-indigo-600 transition"
                >
                    Send Reply
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
