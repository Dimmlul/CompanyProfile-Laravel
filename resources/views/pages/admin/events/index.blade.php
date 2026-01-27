<!-- resources/views/pages/admin/events/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Events')

@section('content')

<x-common.component-card title="Events">

    <!-- Header -->
    <div class="mb-4 flex items-center justify-between">
        <span class="text-sm text-gray-500 dark:text-gray-400">
            Manage events
        </span>

        <a href="{{ route('admin.events.create') }}"
           class="rounded-lg bg-btn-primary px-4 py-2 text-sm font-medium text-btn-text hover:bg-btn-primary-hover">
            + New Event
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th class="px-4 py-3 text-left">Image</th>
                    <th class="px-4 py-3 text-left">Title</th>
                    <th class="px-4 py-3 text-left">Location</th>
                    <th class="px-4 py-3 text-left">Start</th>
                    <th class="px-4 py-3 text-left">End</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($events as $event)
                    <tr class="border-b border-gray-100 dark:border-gray-800">

                        <!-- Image -->
                        <td class="px-4 py-3">
                            @if ($event->image)
                                <img
                                    src="{{ asset('storage/' . $event->image) }}"
                                    class="h-12 w-16 rounded object-cover"
                                >
                            @else
                                <span class="text-xs text-gray-400">No image</span>
                            @endif
                        </td>

                        <!-- Title -->
                        <td class="px-4 py-3 font-medium text-gray-800 dark:text-white/90">
                            {{ $event->title }}
                        </td>

                        <!-- Location -->
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                            {{ $event->location ?? '-' }}
                        </td>

                        <!-- Start -->
                        <td class="px-4 py-3 text-gray-500">
                            {{ $event->start_date?->format('d M Y H:i') ?? '-' }}
                        </td>

                        <!-- End -->
                        <td class="px-4 py-3 text-gray-500">
                            {{ $event->end_date?->format('d M Y H:i') ?? '-' }}
                        </td>

                        <!-- Status -->
                        <td class="px-4 py-3">
                            @if ($event->is_active)
                                <span class="rounded bg-green-100 px-2 py-1 text-xs text-green-700 dark:bg-green-900/40 dark:text-green-400">
                                    Active
                                </span>
                            @else
                                <span class="rounded bg-gray-200 px-2 py-1 text-xs text-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <!-- Action -->
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex gap-2">

                                <a href="{{ route('admin.events.edit', $event) }}"
                                   class="rounded-md bg-btn-primary px-3 py-1.5 text-xs text-btn-text hover:bg-btn-primary-hover">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.events.destroy', $event) }}"
                                      onsubmit="return confirm('Delete this event?')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-md bg-red-600 px-3 py-1.5 text-xs text-white hover:bg-red-700"
                                    >
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            No events found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $events->links() }}
    </div>

</x-common.component-card>

@endsection
