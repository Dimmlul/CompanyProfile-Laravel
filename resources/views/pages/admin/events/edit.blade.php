@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')

<x-common.component-card title="Edit Event">

    <x-admin.event.form
        :action="route('admin.events.update', $event)"
        method="PUT"
        :event="$event"
    />

</x-common.component-card>

@endsection
