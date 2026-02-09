@extends('layouts.app')

@section('title', 'My Messages')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-6xl px-6 space-y-8">

        {{-- HEADER --}}
        <div>
            <h1 class="text-2xl font-semibold text-white">
                My Messages
            </h1>
            <p class="mt-1 text-sm text-app-muted">
                Conversations between you and admin
            </p>
        </div>

        {{-- LIST --}}
        <div class="space-y-4">
           @forelse ($messages as $message)
<a href="{{ route('user.messages.show', $message) }}"
   class="block rounded-2xl border border-white/10 bg-white/5 p-6 hover:bg-white/10">

    <div class="flex justify-between gap-6">

        {{-- LEFT --}}
        <div class="space-y-1 min-w-0">
            <p class="font-medium text-white truncate">
                {{ $message->subject ?? 'No subject' }}
            </p>

            <p class="text-sm text-app-muted line-clamp-2">
                {{ $message->message }}
            </p>
        </div>

        {{-- RIGHT --}}
        <div class="text-right space-y-1 shrink-0">
            <p class="text-xs text-app-muted">
                {{ $message->created_at->format('d M Y') }}
            </p>

            @if ($message->unread_replies > 0)
                <span class="inline-flex items-center rounded-full bg-indigo-500/20 px-2 py-0.5 text-xs text-indigo-400">
                    {{ $message->unread_replies }} new
                </span>
            @endif
        </div>

    </div>
</a>
@empty
    <p class="text-app-muted text-center">No conversations yet.</p>
@endforelse

        </div>

        {{-- PAGINATION --}}
        @if ($messages->hasPages())
            <div class="pt-6">
                {{ $messages->links() }}
            </div>
        @endif

    </div>
</section>
@endsection
