<!-- resources/views/pages/admin/clients/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Clients')

@section('content')

<x-common.component-card title="Clients">

    <div class="mb-4 flex items-center justify-between">
        <span class="text-sm text-gray-500 dark:text-gray-400">
            Manage clients
        </span>

        <a href="{{ route('admin.clients.create') }}"
           class="inline-flex items-center gap-2
                  rounded-lg bg-btn-primary px-4 py-2
                  text-sm font-medium text-btn-text
                  hover:bg-btn-primary-hover transition">
            + New Client
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th class="px-4 py-3 text-left">Logo</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Website</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Order</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($clients as $client)
                    <tr class="border-b border-gray-100 dark:border-gray-800">

                        <td class="px-4 py-3">
                            @if ($client->logo)
                                <img src="{{ asset('storage/'.$client->logo) }}"
                                     class="h-10 w-20 object-contain">
                            @else
                                <span class="text-xs text-gray-400">No logo</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 font-medium">
                            {{ $client->name }}
                        </td>

                        <td class="px-4 py-3 text-gray-500">
                            {{ $client->website ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            @if ($client->is_active)
                                <span class="rounded bg-green-100 px-2 py-1 text-xs text-green-700">
                                    Active
                                </span>
                            @else
                                <span class="rounded bg-gray-200 px-2 py-1 text-xs text-gray-700">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            {{ $client->order }}
                        </td>

                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex gap-2">

                                <a href="{{ route('admin.clients.edit', $client) }}"
                                   class="rounded-md bg-btn-primary px-3 py-1.5
                                          text-xs font-medium text-btn-text
                                          hover:bg-btn-primary-hover">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.clients.destroy', $client) }}"
                                      onsubmit="return confirm('Delete this client?')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="rounded-md bg-danger px-3 py-1.5
                                               text-xs font-medium text-white
                                               hover:bg-danger/90">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="px-4 py-6 text-center text-gray-500">
                            No clients found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $clients->links() }}
    </div>

</x-common.component-card>

@endsection
