@extends('layouts.admin')

@section('title', 'Create Event')

@section('content')

<x-common.component-card title="Create Event">

    <x-admin.event.form
        :action="route('admin.events.store')"
    />

</x-common.component-card>

@endsection
