<!-- resources/views/pages/admin/orders/index.blade.php -->

{{-- Admin page listing all customer orders with their items, totals, and payment status. --}}
@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

<x-common.component-card
    title="Orders"
    desc="List of all customer orders"
>

    <x-common.table.simple
        :headers="['Order', 'Customer', 'Products', 'Total', 'Status', 'Action']"
    >
        @forelse ($orders as $order)
            <tr>

                {{-- ORDER NUMBER --}}
                <td class="font-mono text-sm">
                    {{ $order->order_number }}
                </td>

                {{-- CUSTOMER --}}
                <td>
                    {{ $order->user->name ?? '-' }}
                </td>

                {{-- PRODUCTS --}}
                <td class="text-sm space-y-1">
                    @foreach ($order->items as $item)
                        <div class="flex items-center gap-1">
                            <span class="text-app-muted">•</span>
                            <span>{{ $item->product->name }}</span>
                            <span class="text-xs text-app-muted">
                                (x{{ $item->qty }})
                            </span>
                        </div>
                    @endforeach
                </td>

                {{-- TOTAL --}}
                <td class="font-medium">
                    Rp {{ number_format($order->total) }}
                </td>

                {{-- STATUS --}}
                <td>
                    <span class="badge badge-muted">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </td>

                {{-- ACTION --}}
                <td>
                    <a
                        href="{{ route('admin.orders.show', $order) }}"
                        class="btn-admin"
                    >
                        View
                    </a>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="6" class="admin-table-empty">
                    No orders found
                </td>
            </tr>
        @endforelse
    </x-common.table.simple>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $orders->links() }}
    </div>

</x-common.component-card>

@endsection
