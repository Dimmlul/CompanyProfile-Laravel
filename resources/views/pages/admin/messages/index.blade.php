@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-semibold text-white">Inbox</h1>
        <p class="text-sm text-app-muted">User conversations</p>
    </div>

    <div class="space-y-4">
        @forelse ($messages as $message)
            <a href="{{ route('admin.messages.show', $message) }}"
               class="block rounded-2xl border border-white/10 bg-white/5 p-6 hover:bg-white/10">

                <div class="flex justify-between gap-6">
                    <div class="space-y-1 min-w-0">
                        <p class="font-medium text-white truncate">
                            {{ $message->subject ?? 'No subject' }}
                        </p>
                        <p class="text-sm text-app-muted">
                            {{ $message->user?->name }}
                        </p>
                        <p class="text-sm text-app-muted line-clamp-2">
                            {{ $message->message }}
                        </p>
                    </div>

                    <div class="text-right shrink-0 space-y-1">
                        <p class="text-xs text-app-muted">
                            {{ $message->created_at->format('d M Y') }}
                        </p>

                        @if ($message->unread_replies > 0)
                            <span class="inline-block rounded-full bg-indigo-500/20 px-2 py-0.5 text-xs text-indigo-400">
                                {{ $message->unread_replies }} new
                            </span>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <p class="text-center text-app-muted">No messages</p>
        @endforelse
    </div>

    {{ $messages->links() }}
</div>
@endsection
