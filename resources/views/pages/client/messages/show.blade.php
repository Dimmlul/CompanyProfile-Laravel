@extends('layouts.app')

@section('title', 'Support Chat')

@section('content')
<section class="bg-app-bg py-24">
<div class="mx-auto max-w-5xl px-6 space-y-12">

    {{-- BACK --}}
    <div>
        <a
            href="{{ route('client.messages.start') }}"
            class="inline-flex items-center gap-2
                   text-sm text-app-muted
                   hover:text-indigo-400 transition"
        >
            ← Start new chat
        </a>
    </div>

    {{-- THREAD --}}
    <div class="rounded-2xl border border-white/10 bg-white/5 p-8 space-y-6">

        {{-- ROOT MESSAGE --}}
        <div class="flex justify-end">
            <div class="max-w-xl rounded-2xl bg-indigo-500 px-5 py-4">
                <p class="text-xs text-indigo-100 mb-1 text-right">
                    {{ $message->client_name }}
                    • {{ $message->created_at->format('d M Y, H:i') }}
                </p>

                <p class="text-sm text-white whitespace-pre-line">
                    {{ $message->message }}
                </p>

                {{-- ROOT ATTACHMENT --}}
                @if ($message->attachment)
                    @if ($message->attachment_type === 'image')
                        <img
                            src="{{ asset('storage/'.$message->attachment) }}"
                            class="mt-3 rounded-lg max-w-xs"
                        >
                    @else
                        <a
                            href="{{ asset('storage/'.$message->attachment) }}"
                            target="_blank"
                            class="mt-3 inline-block text-sm text-white underline"
                        >
                            Download file
                        </a>
                    @endif
                @endif
            </div>
        </div>

        {{-- REPLIES --}}
        @foreach ($replies as $reply)

            @if ($reply->sender === 'admin')
                {{-- ADMIN --}}
                <div class="flex justify-start">
                    <div class="max-w-xl rounded-2xl bg-white/10 px-5 py-4">
                        <p class="text-xs text-app-muted mb-1">
                            Admin • {{ $reply->created_at->format('H:i') }}
                        </p>

                        <p class="text-sm text-white whitespace-pre-line">
                            {{ $reply->message }}
                        </p>

                        {{-- ADMIN ATTACHMENT --}}
                        @if ($reply->attachment)
                            @if ($reply->attachment_type === 'image')
                                <img
                                    src="{{ asset('storage/'.$reply->attachment) }}"
                                    class="mt-3 rounded-lg max-w-xs"
                                >
                            @else
                                <a
                                    href="{{ asset('storage/'.$reply->attachment) }}"
                                    target="_blank"
                                    class="mt-3 inline-block text-sm text-indigo-400 underline"
                                >
                                    Download file
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            @else
                {{-- CLIENT --}}
                <div class="flex justify-end">
                    <div class="max-w-xl rounded-2xl bg-indigo-500 px-5 py-4">
                        <p class="text-xs text-indigo-100 mb-1 text-right">
                            You • {{ $reply->created_at->format('H:i') }}
                        </p>

                        <p class="text-sm text-white whitespace-pre-line">
                            {{ $reply->message }}
                        </p>

                        {{-- CLIENT ATTACHMENT --}}
                        @if ($reply->attachment)
                            @if ($reply->attachment_type === 'image')
                                <img
                                    src="{{ asset('storage/'.$reply->attachment) }}"
                                    class="mt-3 rounded-lg max-w-xs"
                                >
                            @else
                                <a
                                    href="{{ asset('storage/'.$reply->attachment) }}"
                                    target="_blank"
                                    class="mt-3 inline-block text-sm text-white underline"
                                >
                                    Download file
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            @endif

        @endforeach
    </div>

    {{-- REPLY FORM --}}
    <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
        <form
            method="POST"
            action="{{ route('client.messages.reply', $token) }}"
            enctype="multipart/form-data"
            class="space-y-4"
        >
            @csrf

            <textarea
                name="message"
                rows="3"
                class="w-full rounded-xl bg-black/40
                       border border-white/10
                       px-4 py-3 text-sm text-white
                       focus:outline-none focus:border-indigo-500"
                placeholder="Type your reply..."
            ></textarea>

            <input
                type="file"
                name="file"
                class="block w-full text-sm text-app-muted
                       file:mr-4 file:rounded-lg
                       file:border-0
                       file:bg-indigo-500/20
                       file:px-4 file:py-2
                       file:text-sm file:font-semibold
                       file:text-indigo-400
                       hover:file:bg-indigo-500/30"
            >

            @error('message')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror

            <div class="flex justify-end">
                <button
                    class="rounded-xl bg-indigo-500 px-6 py-2.5
                           text-sm font-semibold text-white
                           hover:bg-indigo-600 transition"
                >
                    Send
                </button>
            </div>
        </form>
    </div>

</div>
</section>
@endsection
