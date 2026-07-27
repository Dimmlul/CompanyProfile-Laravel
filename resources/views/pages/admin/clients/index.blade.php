{{-- Admin: clients list. --}}
@extends('layouts.admin')

@section('title', 'Clients')

@section('content')
<x-common.component-card title="Clients">

    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-text-muted">
            Manage clients
        </p>

        <a href="{{ route('admin.clients.create') }}" class="btn-primary">
            + New Client
        </a>
    </div>

    <x-admin.client.table :clients="$clients" />

    <div class="mt-4">
        {{ $clients->links() }}
    </div>

</x-common.component-card>
@endsection
