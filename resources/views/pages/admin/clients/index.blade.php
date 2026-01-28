{{-- FILE: admin/clients/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Clients')

@section('content')

<x-common.component-card title="Clients">

    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-text-muted">
            Manage clients
        </p>

        <a href="{{ route('admin.clients.create') }}"
           class="btn-primary">
            + New Client
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="admin-table">

            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Website</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($clients as $client)
                    <tr>

                        <td>
                            @if ($client->logo)
                                <img src="{{ asset('storage/'.$client->logo) }}"
                                     class="h-10 w-20 object-contain">
                            @else
                                <span class="text-text-muted text-xs">No logo</span>
                            @endif
                        </td>

                        <td class="font-medium">
                            {{ $client->name }}
                        </td>

                        <td class="text-text-muted">
                            {{ $client->website ?? '-' }}
                        </td>

                        <td>
                            @if ($client->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-muted">Inactive</span>
                            @endif
                        </td>

                        <td>
                            {{ $client->order }}
                        </td>

                        <td class="text-right">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('admin.clients.edit', $client) }}"
                                   class="btn-admin">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.clients.destroy', $client) }}"
                                      onsubmit="return confirm('Delete this client?')">
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
                        <td colspan="6" class="admin-table-empty">
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
