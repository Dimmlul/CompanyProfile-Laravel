@extends('layouts.admin')

@section('title', 'My Messages')

@section('content')
<div class="mx-auto max-w-5xl px-6 py-16">

    {{-- HEADER --}}
    <div class="mb-10">
        <h1 class="text-2xl font-semibold text-app-text">
            My Messages
        </h1>
        <p class="mt-1 text-sm text-app-muted">
            Messages you’ve received via contact form
        </p>
    </div>

    {{-- MESSAGE LIST --}}
    <div class="space-y-4">

        @forelse ($messages as $message)
            <a
                href="{{ route('user.messages.show', $message) }}"
                class="block rounded-2xl border border-white/10
                       bg-white/[0.015] p-6
                       transition hover:bg-white/[0.03]"
            >
                <div class="flex items-start justify-between gap-6">

                    <div class="min-w-0">
                        <p class="font-medium text-white">
                            {{ $message->subject ?: 'No Subject' }}
                        </p>

                        <p class="mt-1 text-sm text-app-muted line-clamp-2">
                            {{ $message->message }}
                        </p>
                    </div>

                    <div class="shrink-0 text-right">
                        <p class="text-xs text-app-muted">
                            {{ $message->created_at->format('d M Y') }}
                        </p>

                        @if (! $message->is_read)
                            <span
                                class="mt-2 inline-block rounded-full
                                       bg-indigo-500/20 px-2 py-0.5
                                       text-xs text-indigo-400"
                            >
                                New
                            </span>
                        @endif
                    </div>

                </div>
            </a>
        @empty
            <div
                class="rounded-2xl border border-white/10
                       bg-white/[0.015] p-10 text-center"
            >
                <p class="text-app-muted">
                    You haven’t received     any messages yet.
                </p>
            </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    @if ($messages->hasPages())
        <div class="mt-10">
            {{ $messages->links() }}
        </div>
    @endif

</div>
@endsection
