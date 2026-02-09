@extends('layouts.app')

@section('title', 'My Messages')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-6xl px-6">

        {{-- HEADER --}}
        <div class="mb-14 max-w-2xl">
            <h1 class="text-3xl font-semibold text-white">
                My Messages
            </h1>
            <p class="mt-3 text-app-muted">
                Messages you’ve sent via our contact form
            </p>
        </div>

        {{-- MESSAGE LIST --}}
        <div class="space-y-5">

            @forelse ($messages as $message)
                <a
                    href="{{ route('user.messages.show', $message) }}"
                    class="group block rounded-2xl
                           border border-white/10
                           bg-white/5 backdrop-blur
                           p-6 transition
                           hover:bg-white/10"
                >
                    <div class="flex items-start justify-between gap-6">

                        <div class="min-w-0">
                            <p class="text-base font-medium text-white">
                                {{ $message->subject ?? 'No Subject' }}
                            </p>

                            <p class="mt-2 line-clamp-2 text-sm text-app-muted">
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
                                           bg-indigo-500/20
                                           px-2.5 py-0.5 text-xs
                                           text-indigo-400"
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
                           bg-white/5 backdrop-blur
                           p-12 text-center"
                >
                    <p class="text-app-muted">
                        You haven’t sent any messages yet.
                    </p>
                </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        @if ($messages->hasPages())
            <div class="mt-12">
                {{ $messages->links() }}
            </div>
        @endif

    </div>
</section>
@endsection
