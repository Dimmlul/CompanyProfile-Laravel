@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="mx-auto max-w-xl px-6 py-16">

    <h1 class="mb-6 text-2xl font-bold text-app-text">
        My Profile
    </h1>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-500/10 px-4 py-3 text-sm text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="space-y-5">

            {{-- Name --}}
            <div>
                <label class="label">Name</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="input"
                    required
                >
            </div>

            {{-- Email --}}
            <div>
                <label class="label">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="input"
                    required
                >
            </div>

            {{-- Password --}}
            <div>
                <label class="label">New Password</label>
                <input
                    type="password"
                    name="password"
                    class="input"
                    placeholder="Leave blank if not changing"
                >
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="label">Confirm Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="input"
                >
            </div>

            <button class="btn-primary">
                Save Changes
            </button>

        </div>
    </form>

</div>

@endsection
