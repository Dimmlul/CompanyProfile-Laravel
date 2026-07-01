@extends('layouts.app')

@section('title', 'Contact Support')

@section('content')
<section class="bg-app-bg py-20">
    <div class="mx-auto max-w-lg space-y-8 px-6">

        {{-- HEADER --}}
        <div class="text-center">
            <span class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-soft text-brand-accent">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
                </svg>
            </span>
            <h1 class="text-3xl font-semibold text-app-heading">Chat with our team</h1>
            <p class="mt-2 text-sm text-app-muted">
                Send us a message and we'll reply right here. We usually respond within one business day.
            </p>
        </div>

        @if (session('error'))
            <div class="rounded-xl border border-danger/30 bg-danger/10 px-4 py-3 text-sm text-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- FORM --}}
        <div class="surface rounded-2xl p-8">
            <form method="POST" action="{{ route('client.messages.store') }}" class="space-y-5">
                @csrf

                @php
                    $field = 'w-full rounded-xl border border-app-border bg-transparent px-4 py-3 text-sm
                              text-app-heading placeholder:text-app-muted focus:border-brand-main focus:outline-none';
                @endphp

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-app-heading">Your name</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()?->name) }}" required placeholder="Jane Doe" class="{{ $field }}">
                    @error('name') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-app-heading">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}" required placeholder="you@example.com" class="{{ $field }}">
                    @error('email') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-app-heading">Message</label>
                    <textarea name="message" rows="4" required placeholder="How can we help?" class="{{ $field }}">{{ old('message') }}</textarea>
                    @error('message') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                </div>

                <button class="btn-primary w-full">Start chat</button>
            </form>
        </div>

        <p class="text-center text-xs text-app-muted">
            Your conversation stays on this device so you can come back to it anytime.
        </p>
    </div>
</section>
@endsection
