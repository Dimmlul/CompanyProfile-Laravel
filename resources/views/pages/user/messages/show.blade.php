@extends('layouts.app')

@section('title', 'Message Detail')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-4xl px-6">

        {{-- BACK --}}
        <a
            href="{{ route('user.messages.index') }}"
            class="mb-10 inline-flex items-center gap-2
                   text-sm text-app-muted
                   hover:text-indigo-400 transition"
        >
            ← Back to messages
        </a>

        {{-- MESSAGE CARD --}}
        <div
            class="rounded-2xl border border-white/10
                   bg-white/5 backdrop-blur
                   p-8"
        >

            {{-- HEADER --}}
            <div class="mb-8">
                <h1 class="text-2xl font-semibold text-white">
                    {{ $message->subject ?? 'Message' }}
                </h1>

                <p class="mt-2 text-sm text-app-muted">
                    Sent on {{ $message->created_at->format('d M Y, H:i') }}
                </p>
            </div>

            {{-- CONTENT --}}
            <div class="whitespace-pre-line text-white/90 leading-relaxed">
                {{ $message->message }}
            </div>

            {{-- META --}}
            <div class="mt-10 border-t border-white/10 pt-6 text-sm text-app-muted space-y-2">
                <p>
                    <span class="text-white/80">Email:</span>
                    {{ $message->email ?? '-' }}
                </p>

                @if ($message->phone)
                    <p>
                        <span class="text-white/80">Phone:</span>
                        {{ $message->phone }}
                    </p>
                @endif

                @if ($message->order)
                    <p>
                        <span class="text-white/80">Related Order:</span>
                        {{ $message->order->order_number }}
                    </p>
                @endif
            </div>

        </div>

    </div>
</section>
@endsection
