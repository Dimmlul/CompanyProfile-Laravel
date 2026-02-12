@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<x-auth.back-button href="/" />

<div class="flex min-h-screen items-center justify-center px-6">
    <x-auth.card>

        <x-auth.card-header
            title="Sign In"
            subtitle="Enter your email and password to continue"
        />

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="space-y-5">

                <x-auth.form-input
                    label="Email"
                    name="email"
                    type="email"
                    placeholder="email@example.com"
                    required
                />

                <x-auth.form-input
                    label="Password"
                    name="password"
                    type="password"
                    placeholder="Enter your password"
                    required
                />

                <x-auth.submit-button>
                    Sign In
                </x-auth.submit-button>

                <p class="text-center text-sm text-app-muted">
                            Don’t have an account?
                            <a href="{{ route('register') }}"
                            class="text-btn-primary hover:underline">
                                Register
                            </a>
                        </p>


            </div>
        </form>

    </x-auth.card>
</div>

@endsection
