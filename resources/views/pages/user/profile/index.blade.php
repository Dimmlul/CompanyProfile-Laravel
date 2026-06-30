@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="mx-auto max-w-xl px-6 py-14">

    {{-- HEADER --}}
    <div class="mb-10">
        <h1 class="text-2xl font-semibold text-app-heading">
            My Profile
        </h1>
        <p class="mt-2 text-sm text-app-muted">
            Manage your account information and security settings.
        </p>
    </div>

    {{-- SUCCESS --}}
    @if (session('success'))
        <div
            class="mb-8 rounded-xl border border-green-500/20
                   bg-green-500/10 px-4 py-3
                   text-sm text-green-400"
        >
            {{ session('success') }}
        </div>
    @endif

    {{-- CARD --}}
    <div class="surface rounded-2xl p-6">

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-10">
            @csrf
            @method('PUT')

            {{-- BASIC INFO --}}
            <section class="space-y-6">

                <x-common.form.input
                    label="Name"
                    name="name"
                    :value="$user->name"
                />

                <x-common.form.input
                    label="Email"
                    name="email"
                    type="email"
                    :value="$user->email"
                />

            </section>

            {{-- DIVIDER --}}
            <div class="border-t border-app-border pt-8">

                <div class="mb-6">
                    <h2 class="text-sm font-semibold text-app-heading">
                        Change Password
                    </h2>
                    <p class="mt-1 text-xs text-app-muted">
                        Leave empty if you don’t want to change your password.
                    </p>
                </div>

                <div class="space-y-6">

                    <x-common.form.input
                        label="New Password"
                        name="password"
                        type="password"
                        placeholder="••••••••"
                    />

                    <x-common.form.input
                        label="Confirm Password"
                        name="password_confirmation"
                        type="password"
                        placeholder="••••••••"
                    />

                </div>
            </div>

            {{-- ACTION --}}
            <div class="flex justify-end pt-2">
                <x-common.form.submit label="Save Changes" />
            </div>

        </form>

    </div>

</div>

@endsection
