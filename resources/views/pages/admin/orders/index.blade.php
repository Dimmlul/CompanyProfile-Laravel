@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

<x-common.component-card title="Orders">

    {{-- HEADER --}}
    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-text-muted">
            Manage customer orders & payments
        </p>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="admin-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($orders as $order)
                    <tr>

                        {{-- NO --}}
                        <td class="text-text-muted">
                            {{ $loop->iteration }}
                        </td>

                        {{-- PRODUCT --}}
                        <td class="font-medium">
                            {{ $order->items->first()->product->name ?? '-' }}
                        </td>

                        {{-- ORDER ID --}}
                        <td class="text-text-muted text-xs">
                            {{ $order->order_number }}
                        </td>

                        {{-- CUSTOMER --}}
                        <td>
                            <div class="font-medium">
                                {{ $order->user->name }}
                            </div>
                            <div class="text-xs text-text-muted">
                                {{ $order->customer_email }}
                            </div>
                        </td>

                        {{-- TOTAL --}}
                        <td class="font-semibold">
                            Rp {{ number_format($order->total) }}
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if ($order->payment_status === 'paid')
                                <span class="badge badge-success">Paid</span>

                            @elseif ($order->payment_status === 'pending')
                                <span class="badge badge-warning">Pending</span>

                            @elseif ($order->payment_status === 'expired')
                                <span class="badge badge-danger">Expired</span>

                            @else
                                <span class="badge badge-muted">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            @endif
                        </td>

                        {{-- CREATED --}}
                        <td class="text-text-muted">
                            {{ $order->created_at->format('d M Y') }}
                        </td>

                        {{-- ACTION --}}
                        <td class="text-right">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="btn-admin">
                                    View
                                </a>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="admin-table-empty">
                            No orders found
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- PAGINATION (kalau pakai paginate) --}}
    @if(method_exists($orders, 'links'))
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @endif

</x-common.component-card>

@endsection
