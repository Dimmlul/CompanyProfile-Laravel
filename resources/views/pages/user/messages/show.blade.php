@extends('layouts.app')

@section('title', $message->subject ?? 'Message')

@section('content')
<section class="bg-app-bg py-16">
    <div class="mx-auto max-w-3xl px-6">

        <x-back-button :href="route('user.messages.index')" label="Back to messages" class="mb-6" />

        <div class="surface overflow-hidden rounded-2xl">

            {{-- HEADER --}}
            <div class="flex items-center gap-3 border-b border-app-border p-5">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-soft text-brand-accent">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-app-heading">{{ $message->subject ?? 'Customer Support' }}</p>
                    <p class="text-xs text-app-muted">Conversation with our team</p>
                </div>
            </div>

            {{-- MESSAGES --}}
            <div class="space-y-4 p-5 sm:p-6">
                <x-chat-bubble own
                    name="You"
                    :time="$message->created_at->format('d M, H:i')"
                    :message="$message->message"
                    :attachment="$message->attachment"
                    :attachmentType="$message->attachment_type" />

                @foreach ($replies as $reply)
                    <x-chat-bubble
                        :own="$reply->sender !== 'admin'"
                        :name="$reply->sender === 'admin' ? 'Admin' : 'You'"
                        :time="$reply->created_at->format('d M, H:i')"
                        :message="$reply->message"
                        :attachment="$reply->attachment"
                        :attachmentType="$reply->attachment_type" />
                @endforeach
            </div>

            {{-- REPLY --}}
            <div class="border-t border-app-border p-4">
                <form method="POST" action="{{ route('user.messages.reply', $message) }}" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <textarea name="message" rows="2" placeholder="Type your reply..."
                              class="w-full rounded-xl border border-app-border bg-transparent px-4 py-3 text-sm text-app-heading placeholder:text-app-muted focus:border-brand-main focus:outline-none">{{ old('message') }}</textarea>

                    @error('message') <p class="text-sm text-danger">{{ $message }}</p> @enderror

                    <div class="flex items-center justify-between gap-3">
                        <input type="file" name="file"
                               class="block max-w-[60%] text-xs text-app-muted file:mr-3 file:rounded-lg file:border-0 file:bg-brand-soft file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-brand-accent">
                        <button class="btn-primary btn-sm">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
