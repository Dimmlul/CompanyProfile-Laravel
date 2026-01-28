{{-- FILE: admin/events/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Events')

@section('content')

<x-common.component-card title="Events">

    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-text-muted">
            Manage events
        </p>

        <a href="{{ route('admin.events.create') }}"
           class="btn-primary">
            + New Event
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="admin-table">

            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($events as $event)
                    <tr>

                        <td>
                            @if ($event->image)
                                <img src="{{ asset('storage/'.$event->image) }}"
                                     class="h-12 w-16 rounded object-cover">
                            @else
                                <span class="text-text-muted text-xs">No image</span>
                            @endif
                        </td>

                        <td class="font-medium">
                            {{ $event->title }}
                        </td>

                        <td class="text-text-muted">
                            {{ $event->location ?? '-' }}
                        </td>

                        <td class="text-text-muted">
                            {{ $event->start_date?->format('d M Y') }}
                        </td>

                        <td class="text-text-muted">
                            {{ $event->end_date?->format('d M Y') ?? '-' }}
                        </td>

                        <td>
                            @if ($event->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-muted">Inactive</span>
                            @endif
                        </td>

                        <td class="text-right">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('admin.events.edit', $event) }}"
                                   class="btn-admin">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.events.destroy', $event) }}"
                                      onsubmit="return confirm('Delete this event?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="admin-table-empty">
                            No events found
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-4">
        {{ $events->links() }}
    </div>

</x-common.component-card>

@endsection
