{{-- Admin page for editing an existing system user. --}}
@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

<x-common.component-card title="Edit User">

    {{-- ALERT --}}
    <x-common.alert />

    <x-admin.user.form
        :user="$user"
        :action="route('admin.users.update', $user)"
        method="PUT"
    />

</x-common.component-card>

@endsection
