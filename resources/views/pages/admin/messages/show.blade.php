@extends('layouts.admin')

@section('title', 'Message')

@section('content')
<div class="max-w-4xl space-y-6">

    <a href="{{ route('admin.messages.index') }}"
       class="text-sm text-app-muted hover:text-indigo-400">
        ← Back
    </a>

    {{-- THREAD --}}
    <div class="space-y-4 rounded-2xl border border-white/10 bg-white/5 p-6">

        {{-- ROOT (USER) --}}
        <div class="flex justify-start">
            <div class="max-w-xl rounded-2xl bg-white/10 px-4 py-3">
                <p class="text-xs text-app-muted mb-1">
                    {{ $message->user?->name }} • {{ $message->created_at->format('H:i') }}
                </p>
                <p class="text-sm text-white whitespace-pre-line">
                    {{ $message->message }}
                </p>
            </div>
        </div>

        {{-- REPLIES --}}
        @foreach ($replies as $reply)
            @if ($reply->sender === 'admin')
                <div class="flex justify-end">
                    <div class="max-w-xl rounded-2xl bg-indigo-500 px-4 py-3">
                        <p class="text-xs text-indigo-100 mb-1 text-right">
                            You • {{ $reply->created_at->format('H:i') }}
                        </p>
                        <p class="text-sm text-white whitespace-pre-line">
                            {{ $reply->message }}
                        </p>

                        @include('pages.shared.message-attachment', ['msg' => $reply])
                    </div>
                </div>
            @else
                <div class="flex justify-start">
                    <div class="max-w-xl rounded-2xl bg-white/10 px-4 py-3">
                        <p class="text-xs text-app-muted mb-1">
                            {{ $message->user?->name }} • {{ $reply->created_at->format('H:i') }}
                        </p>
                        <p class="text-sm text-white whitespace-pre-line">
                            {{ $reply->message }}
                        </p>

                        @include('pages.shared.message-attachment', ['msg' => $reply])
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{-- REPLY FORM --}}
    <form method="POST"
          action="{{ route('admin.messages.reply', $message) }}"
          enctype="multipart/form-data"
          class="space-y-4">
        @csrf

        <textarea name="message" rows="3"
                  class="client-input w-full rounded-xl"
                  placeholder="Reply..."></textarea>

        <input type="file" name="file" class="client-input">

        <button class="rounded-xl bg-indigo-500 px-6 py-2 text-white hover:bg-indigo-600">
            Send Reply
        </button>
    </form>

    @if ($reply->attachment)
    @if ($reply->attachment_type === 'image')
        <img
            src="{{ asset('storage/'.$reply->attachment) }}"
            class="mt-2 rounded-lg max-w-xs"
        >
    @else
        <a
            href="{{ asset('storage/'.$reply->attachment) }}"
            target="_blank"
            class="mt-2 inline-block text-sm text-indigo-400 underline"
        >
            Download file
        </a>
    @endif
@endif

</div>
@endsection
