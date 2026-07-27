{{-- Registration page. --}}
@extends('layouts.auth')

@section('title', 'Register')

@section('content')

<x-auth.back-button href="/" />

<div class="flex min-h-screen items-center justify-center px-6">
    <x-auth.card>

        <x-auth.card-header
            title="Create Account"
            subtitle="Fill the form below to get started"
        />

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <div class="space-y-5">

                <x-auth.form-input
                    label="Name"
                    name="name"
                    type="text"
                    placeholder="Your full name"
                    required
                />

                <x-auth.form-input
                    label="Email"
                    name="email"
                    type="email"
                    placeholder="you@example.com"
                    required
                />

                <x-auth.form-input
                    label="Password"
                    name="password"
                    type="password"
                    placeholder="Create a password"
                    required
                />

                <x-auth.form-input
                    label="Confirm Password"
                    name="password_confirmation"
                    type="password"
                    placeholder="Repeat your password"
                    required
                />

                <x-auth.submit-button>
                    Register
                </x-auth.submit-button>

                <p class="text-center text-sm text-app-muted">
                    Already have an account?
                    <a href="{{ route('login') }}"
                       class="text-btn-primary hover:underline">
                        Sign In
                    </a>
                </p>

            </div>
        </form>

    </x-auth.card>
</div>

@endsection
