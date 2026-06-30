@extends('layouts.app')

@section('title', 'Message')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-5xl space-y-12 px-6">

        {{-- BACK --}}
        <div class="pt-2">
            <a href="{{ route('user.messages.index') }}"
               class="inline-flex items-center gap-2 text-sm text-app-muted transition hover:text-app-heading">
                &larr; Back to messages
            </a>
        </div>

        {{-- THREAD --}}
        <div class="surface space-y-8 rounded-2xl p-8">

            {{-- ROOT MESSAGE --}}
            <div class="flex justify-end">
                <div class="max-w-xl rounded-2xl bg-brand-main px-5 py-4">
                    <p class="mb-1 text-right text-xs text-indigo-100">
                        You &bull; {{ $message->created_at->format('d M Y, H:i') }}
                    </p>
                    <p class="whitespace-pre-line text-sm text-white">{{ $message->message }}</p>
                </div>
            </div>

            {{-- REPLIES --}}
            @foreach ($replies as $reply)
                @if ($reply->sender === 'admin')
                    {{-- ADMIN --}}
                    <div class="flex justify-start">
                        <div class="max-w-xl rounded-2xl bg-app-surface-2 px-5 py-4">
                            <p class="mb-1 text-xs text-app-muted">Admin &bull; {{ $reply->created_at->format('H:i') }}</p>

                            @if ($reply->message && $reply->message !== '[Attachment]')
                                <p class="whitespace-pre-line text-sm text-app-heading">{{ $reply->message }}</p>
                            @endif

                            @if ($reply->attachment)
                                <div class="mt-3">
                                    @if ($reply->attachment_type === 'image')
                                        <a href="{{ asset('storage/'.$reply->attachment) }}" target="_blank">
                                            <img src="{{ asset('storage/'.$reply->attachment) }}"
                                                 class="max-w-xs rounded-xl border border-app-border transition hover:opacity-90">
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/'.$reply->attachment) }}" target="_blank"
                                           class="inline-flex items-center gap-2 text-sm text-brand-accent underline">Download file</a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    {{-- USER --}}
                    <div class="flex justify-end">
                        <div class="max-w-xl rounded-2xl bg-brand-main px-5 py-4">
                            <p class="mb-1 text-right text-xs text-indigo-100">You &bull; {{ $reply->created_at->format('H:i') }}</p>
                            <p class="whitespace-pre-line text-sm text-white">{{ $reply->message }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- USER REPLY FORM --}}
        <div class="surface rounded-2xl p-6">
            <form method="POST" action="{{ route('user.messages.reply', $message) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <textarea name="message" rows="4" placeholder="Reply to admin..."
                          class="w-full rounded-xl border border-app-border bg-transparent px-4 py-3 text-sm
                                 text-app-heading placeholder:text-app-muted focus:border-brand-main focus:outline-none">{{ old('message') }}</textarea>

                <input type="file" name="file"
                       class="block w-full text-sm text-app-muted file:mr-4 file:rounded-lg file:border-0
                              file:bg-brand-soft file:px-4 file:py-2 file:text-sm file:font-semibold file:text-brand-accent">

                @error('message')
                    <p class="text-sm text-danger">{{ $message }}</p>
                @enderror

                <div class="flex justify-end pt-2">
                    <button class="btn-primary">Send Reply</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
