@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="space-y-8">

    {{-- HEADER --}}
    <div>
        <h1 class="text-xl font-semibold text-app-heading">Inbox</h1>
        <p class="mt-1 text-sm text-app-muted">Conversations from users &amp; clients</p>
    </div>

    {{-- LIST --}}
    <div class="space-y-3">
        @forelse ($messages as $message)
            @php
                $unread = ($message->unread_user_replies ?? 0) + ($message->unread_client_replies ?? 0);
                $name = $message->sender === 'client'
                    ? ($message->client_name ?? 'Client')
                    : ($message->user?->name ?? 'User #'.$message->user_id);
                $initial = strtoupper(mb_substr($name, 0, 1));
            @endphp

            <a href="{{ route('admin.messages.show', $message) }}"
               class="group surface surface-hover flex items-start gap-4 rounded-2xl p-5">

                {{-- avatar --}}
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-brand-soft text-sm font-semibold text-brand-accent">
                    {{ $initial }}
                </span>

                {{-- body --}}
                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-2">
                        <p class="truncate font-medium text-app-heading">{{ $message->subject ?? 'Support chat' }}</p>
                        <span class="shrink-0 rounded-full bg-app-surface-2 px-2 py-0.5 text-[11px] font-medium text-app-muted">
                            {{ $message->sender === 'client' ? 'Client' : 'User' }}
                        </span>
                    </div>
                    <p class="mt-0.5 text-sm text-app-muted">{{ $name }}</p>
                    <p class="mt-1 line-clamp-1 text-sm text-app-muted">{{ $message->message }}</p>
                </div>

                {{-- meta --}}
                <div class="shrink-0 space-y-2 text-right">
                    <p class="text-xs text-app-muted">{{ $message->created_at->format('d M Y') }}</p>
                    @if ($unread > 0)
                        <span class="inline-flex items-center rounded-full bg-brand-main px-2.5 py-0.5 text-xs font-semibold text-white">
                            {{ $unread }} new
                        </span>
                    @endif
                </div>
            </a>
        @empty
            <x-empty-state
                icon="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"
                title="No messages yet"
                description="Conversations from users and clients will appear here." />
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if ($messages->hasPages())
        <div class="pt-2">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
