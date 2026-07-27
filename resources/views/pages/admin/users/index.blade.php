{{-- Admin page listing all system users with pagination and a link to create a new one. --}}
@extends('layouts.admin')

@section('title', 'Users')

@section('content')

<x-common.component-card title="Users">

    {{-- ALERT --}}
    <x-common.alert />
    <x-common.alert type="success" />

    {{-- HEADER --}}
    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-text-muted">
            Manage system users
        </p>

        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            + New User
        </a>
    </div>

    <x-admin.user.table :users="$users" />

    <div class="mt-4">
        {{ $users->links() }}
    </div>

</x-common.component-card>

@endsection
