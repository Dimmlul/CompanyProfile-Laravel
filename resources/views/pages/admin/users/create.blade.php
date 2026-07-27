{{-- Admin page for creating a new system user. --}}
@extends('layouts.admin')

@section('title', 'Create User')

@section('content')

{{-- ALERT --}}
<x-common.alert />

<x-common.component-card title="Create User">

    <x-admin.user.form
        :action="route('admin.users.store')"
    />

</x-common.component-card>

@endsection
