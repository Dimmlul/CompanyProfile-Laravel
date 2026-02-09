@extends('layouts.app')

@section('title', 'Message Detail')

@section('content')
<div class="mx-auto max-w-3xl px-6 py-16">

    {{-- BACK --}}
    <a
        href="{{ route('user.messages.index') }}"
        class="mb-6 inline-flex items-center gap-2
               text-sm text-app-muted
               hover:text-indigo-400 transition"
    >
        ← Back to messages
    </a>

    {{-- CARD --}}
    <div
        class="rounded-2xl border border-white/10
               bg-white/[0.015] p-8"
    >

        <div class="mb-6">
            <h1 class="text-xl font-semibold text-white">
                {{ $message->subject ?: 'No Subject' }}
            </h1>

            <p class="mt-1 text-sm text-app-muted">
                Sent on {{ $message->created_at->format('d M Y, H:i') }}
            </p>
        </div>

        {{-- MESSAGE CONTENT --}}
        <div class="prose prose-invert max-w-none text-white/90">
            {!! nl2br(e($message->message)) !!}
        </div>

        {{-- META --}}
        <div class="mt-8 border-t border-white/10 pt-6 text-sm text-app-muted">
            <p>
                Email:
                <span class="text-white/80">
                    {{ $message->email ?? '-' }}
                </span>
            </p>

            @if ($message->phone)
                <p class="mt-1">
                    Phone:
                    <span class="text-white/80">
                        {{ $message->phone }}
                    </span>
                </p>
            @endif

            @if ($message->order)
                <p class="mt-1">
                    Related Order:
                    <span class="text-white/80">
                        {{ $message->order->order_number }}
                    </span>
                </p>
            @endif
        </div>

    </div>

</div>
@endsection
