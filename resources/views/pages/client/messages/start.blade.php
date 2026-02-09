@extends('layouts.app')

@section('title', 'Contact Support')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-lg px-6 space-y-8">

        {{-- HEADER --}}
        <div class="text-center">
            <h1 class="text-3xl font-semibold text-white">
                Contact Support
            </h1>
            <p class="mt-2 text-sm text-app-muted">
                Start a conversation with our team
            </p>
        </div>

        {{-- FORM --}}
        <div class="rounded-2xl border border-white/10 bg-white/5 p-8">
            <form
                method="POST"
                action="{{ route('client.messages.store') }}"
                class="space-y-5"
            >
                @csrf

                {{-- NAME --}}
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    placeholder="Your name"
                    class="w-full rounded-xl bg-black/40
                           border border-white/10
                           px-4 py-3 text-sm text-white
                           focus:outline-none focus:border-indigo-500"
                >

                {{-- EMAIL --}}
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    placeholder="Your email"
                    class="w-full rounded-xl bg-black/40
                           border border-white/10
                           px-4 py-3 text-sm text-white
                           focus:outline-none focus:border-indigo-500"
                >

                {{-- MESSAGE --}}
                <textarea
                    name="message"
                    rows="4"
                    required
                    placeholder="Tell us what you need..."
                    class="w-full rounded-xl bg-black/40
                           border border-white/10
                           px-4 py-3 text-sm text-white
                           focus:outline-none focus:border-indigo-500"
                >{{ old('message') }}</textarea>

                @error('message')
                    <p class="text-sm text-red-400">{{ $message }}</p>
                @enderror

                {{-- SUBMIT --}}
                <button
                    class="w-full rounded-xl bg-indigo-500 py-3
                           text-sm font-semibold text-white
                           hover:bg-indigo-600 transition"
                >
                    Start Chat
                </button>
            </form>
        </div>

    </div>
</section>
@endsection
