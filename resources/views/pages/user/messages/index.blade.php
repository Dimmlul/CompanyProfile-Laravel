{{-- User's inbox: lists their support conversations with the admin team. --}}
@extends('layouts.app')

@section('title', 'My Messages')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-6xl space-y-8 px-6">

        {{-- HEADER --}}
        <div>
            <h1 class="text-2xl font-semibold text-app-heading">My Messages</h1>
            <p class="mt-1 text-sm text-app-muted">Conversations between you and admin</p>
        </div>

        {{-- LIST --}}
        <div class="space-y-4">
            @forelse ($messages as $message)
                <a href="{{ route('user.messages.show', $message) }}" class="surface surface-hover block rounded-2xl p-6">
                    <div class="flex justify-between gap-6">
                        <div class="min-w-0 space-y-1">
                            <p class="truncate font-medium text-app-heading">{{ $message->subject ?? 'No subject' }}</p>
                            <p class="line-clamp-2 text-sm text-app-muted">{{ $message->message }}</p>
                        </div>

                        <div class="shrink-0 space-y-1 text-right">
                            <p class="text-xs text-app-muted">{{ $message->created_at->format('d M Y') }}</p>
                            @if ($message->unread_replies > 0)
                                <span class="inline-flex items-center rounded-full bg-brand-soft px-2 py-0.5 text-xs text-brand-accent">
                                    {{ $message->unread_replies }} new
                                </span>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <x-empty-state
                    icon="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"
                    title="No conversations yet"
                    description="Start a chat with our team and your conversation will appear here.">
                    <a href="{{ route('client.messages.start') }}" class="btn-primary btn-sm">Start a chat</a>
                </x-empty-state>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if ($messages->hasPages())
            <div class="pt-6">{{ $messages->links() }}</div>
        @endif
    </div>
</section>
@endsection
