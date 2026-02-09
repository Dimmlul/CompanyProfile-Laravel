@extends('layouts.admin')

@section('title', 'Create Client')

@section('content')

<x-common.component-card title="Create Client">
    <x-admin.client.form
        :action="route('admin.clients.store')"
    />
</x-common.component-card>

@endsection
