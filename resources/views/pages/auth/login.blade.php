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
                    placeholder="admin@example.com"
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

            </div>
        </form>

    </x-auth.card>
</div>

@endsection
