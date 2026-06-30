@extends('layouts.app')

@section('title', 'Support Chat')

@section('content')
<section class="bg-app-bg py-24">
<div class="mx-auto max-w-5xl space-y-12 px-6">

    {{-- BACK --}}
    <div>
        <a href="{{ route('client.messages.start') }}"
           class="inline-flex items-center gap-2 text-sm text-app-muted transition hover:text-app-heading">
            &larr; Start new chat
        </a>
    </div>

    {{-- THREAD --}}
    <div class="surface space-y-6 rounded-2xl p-8">

        {{-- ROOT MESSAGE --}}
        <div class="flex justify-end">
            <div class="max-w-xl rounded-2xl bg-brand-main px-5 py-4">
                <p class="mb-1 text-right text-xs text-indigo-100">
                    {{ $message->client_name }} &bull; {{ $message->created_at->format('d M Y, H:i') }}
                </p>
                <p class="whitespace-pre-line text-sm text-white">{{ $message->message }}</p>

                @if ($message->attachment)
                    @if ($message->attachment_type === 'image')
                        <img src="{{ asset('storage/'.$message->attachment) }}" class="mt-3 max-w-xs rounded-lg">
                    @else
                        <a href="{{ asset('storage/'.$message->attachment) }}" target="_blank"
                           class="mt-3 inline-block text-sm text-white underline">Download file</a>
                    @endif
                @endif
            </div>
        </div>

        {{-- REPLIES --}}
        @foreach ($replies as $reply)
            @if ($reply->sender === 'admin')
                {{-- ADMIN --}}
                <div class="flex justify-start">
                    <div class="max-w-xl rounded-2xl bg-app-surface-2 px-5 py-4">
                        <p class="mb-1 text-xs text-app-muted">Admin &bull; {{ $reply->created_at->format('H:i') }}</p>
                        <p class="whitespace-pre-line text-sm text-app-heading">{{ $reply->message }}</p>

                        @if ($reply->attachment)
                            @if ($reply->attachment_type === 'image')
                                <img src="{{ asset('storage/'.$reply->attachment) }}" class="mt-3 max-w-xs rounded-lg">
                            @else
                                <a href="{{ asset('storage/'.$reply->attachment) }}" target="_blank"
                                   class="mt-3 inline-block text-sm text-brand-accent underline">Download file</a>
                            @endif
                        @endif
                    </div>
                </div>
            @else
                {{-- CLIENT --}}
                <div class="flex justify-end">
                    <div class="max-w-xl rounded-2xl bg-brand-main px-5 py-4">
                        <p class="mb-1 text-right text-xs text-indigo-100">You &bull; {{ $reply->created_at->format('H:i') }}</p>
                        <p class="whitespace-pre-line text-sm text-white">{{ $reply->message }}</p>

                        @if ($reply->attachment)
                            @if ($reply->attachment_type === 'image')
                                <img src="{{ asset('storage/'.$reply->attachment) }}" class="mt-3 max-w-xs rounded-lg">
                            @else
                                <a href="{{ asset('storage/'.$reply->attachment) }}" target="_blank"
                                   class="mt-3 inline-block text-sm text-white underline">Download file</a>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{-- REPLY FORM --}}
    <div class="surface rounded-2xl p-6">
        <form method="POST" action="{{ route('client.messages.reply', $token) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <textarea name="message" rows="3" placeholder="Type your reply..."
                      class="w-full rounded-xl border border-app-border bg-transparent px-4 py-3 text-sm
                             text-app-heading placeholder:text-app-muted focus:border-brand-main focus:outline-none"></textarea>

            <input type="file" name="file"
                   class="block w-full text-sm text-app-muted file:mr-4 file:rounded-lg file:border-0
                          file:bg-brand-soft file:px-4 file:py-2 file:text-sm file:font-semibold file:text-brand-accent">

            @error('message')
                <p class="text-sm text-danger">{{ $message }}</p>
            @enderror

            <div class="flex justify-end">
                <button class="btn-primary">Send</button>
            </div>
        </form>
    </div>

</div>
</section>
@endsection
