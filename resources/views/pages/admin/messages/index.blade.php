@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="space-y-8">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-white">
            Inbox Messages
        </h1>
        <p class="mt-1 text-sm text-app-muted">
            Messages sent by users via contact form
        </p>
    </div>

    {{-- LIST --}}
    <div class="space-y-4">

        @forelse ($messages as $message)
            <a
                href="{{ route('admin.messages.show', $message) }}"
                class="group block rounded-2xl
                       border border-white/10
                       bg-white/5 backdrop-blur
                       p-6 transition
                       hover:bg-white/10"
            >
                <div class="flex items-start justify-between gap-6">

                    {{-- LEFT --}}
                    <div class="min-w-0 space-y-2">
                        <p class="font-medium text-white">
                            {{ $message->subject ?? '(No subject)' }}
                        </p>

                        <p class="text-sm text-app-muted">
                            From {{ $message->user?->name ?? 'User' }}
                        </p>

                        <p class="line-clamp-2 text-sm text-app-muted">
                            {{ $message->message }}
                        </p>
                    </div>

                    {{-- RIGHT --}}
                    <div class="shrink-0 text-right space-y-2">
                        <p class="text-xs text-app-muted">
                            {{ $message->created_at->format('d M Y') }}
                        </p>

                        @if (! $message->is_read)
                            <span
                                class="inline-flex items-center rounded-full
                                       bg-indigo-500/20 px-2.5 py-0.5
                                       text-xs font-medium text-indigo-400"
                            >
                                New
                            </span>
                        @else
                            <span class="text-xs text-app-muted">
                                Read
                            </span>
                        @endif
                    </div>

                </div>
            </a>
        @empty
            <div
                class="rounded-2xl border border-white/10
                       bg-white/5 backdrop-blur
                       p-12 text-center"
            >
                <p class="text-app-muted">
                    No messages yet.
                </p>
            </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    @if ($messages->hasPages())
        <div class="pt-6">
            {{ $messages->links() }}
        </div>
    @endif

</div>
@endsection
