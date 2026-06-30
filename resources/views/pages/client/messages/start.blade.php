@extends('layouts.app')

@section('title', 'Contact Support')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-lg space-y-8 px-6">

        {{-- HEADER --}}
        <div class="text-center">
            <h1 class="text-3xl font-semibold text-app-heading">Contact Support</h1>
            <p class="mt-2 text-sm text-app-muted">Start a conversation with our team</p>
        </div>

        {{-- FORM --}}
        <div class="surface rounded-2xl p-8">
            <form method="POST" action="{{ route('client.messages.store') }}" class="space-y-5">
                @csrf

                @php
                    $field = 'w-full rounded-xl border border-app-border bg-transparent px-4 py-3 text-sm
                              text-app-heading placeholder:text-app-muted focus:border-brand-main focus:outline-none';
                @endphp

                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Your name" class="{{ $field }}">
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Your email" class="{{ $field }}">
                <textarea name="message" rows="4" required placeholder="Tell us what you need..." class="{{ $field }}">{{ old('message') }}</textarea>

                @error('message')
                    <p class="text-sm text-danger">{{ $message }}</p>
                @enderror

                <button class="btn-primary w-full">Start Chat</button>
            </form>
        </div>
    </div>
</section>
@endsection
