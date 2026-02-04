@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="mx-auto max-w-xl px-6 py-16">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-app-text">
            My Profile
        </h1>
        <p class="mt-1 text-sm text-app-muted">
            Manage your account information and security settings.
        </p>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div
            class="mb-6 rounded-xl border border-green-500/20
                   bg-green-500/10 px-4 py-3
                   text-sm text-green-400"
        >
            {{ session('success') }}
        </div>
    @endif

    {{-- Profile Card --}}
    <div class="rounded-2xl border border-card-border bg-card p-6">

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="space-y-6">

                {{-- NAME --}}
                <div>
                    <label class="label">Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="input"
                        required
                    >
                    @error('name')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="label">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="input"
                        required
                    >
                    @error('email')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- DIVIDER --}}
                <div class="border-t border-card-border pt-6">

                    <h2 class="mb-1 text-sm font-semibold text-app-text">
                        Change Password
                    </h2>
                    <p class="mb-4 text-xs text-app-muted">
                        Leave these fields empty if you don’t want to change your password.
                    </p>

                    <div class="space-y-5">

                        {{-- PASSWORD --}}
                        <div>
                            <label class="label">New Password</label>
                            <input
                                type="password"
                                name="password"
                                class="input"
                                placeholder="••••••••"
                            >
                            @error('password')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div>
                            <label class="label">Confirm Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="input"
                                placeholder="••••••••"
                            >
                        </div>

                    </div>
                </div>

                {{-- ACTION --}}
                <div class="pt-4">
                    <button
                        type="submit"
                        class="btn-primary w-full sm:w-auto"
                    >
                        Save Changes
                    </button>
                </div>

            </div>
        </form>

    </div>

</div>

@endsection
