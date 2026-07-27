{{-- Admin: events list. --}}
@extends('layouts.admin')

@section('title', 'Events')

@section('content')

<x-common.component-card title="Events">

    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-text-muted">
            Manage events
        </p>

        <a href="{{ route('admin.events.create') }}" class="btn-primary">
            + New Event
        </a>
    </div>

    <x-admin.event.table :events="$events" />

    <div class="mt-4">
        {{ $events->links() }}
    </div>

</x-common.component-card>

@endsection
