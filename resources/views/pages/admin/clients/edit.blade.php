@extends('layouts.admin')

@section('title', 'Edit Client')

@section('content')
<x-common.component-card title="Edit Client">
    <x-admin.client.form
        :action="route('admin.clients.update', $client)"
        method="PUT"
        :client="$client"
    />
</x-common.component-card>
@endsection
