@extends('layouts.admin')

@section('title', 'Order Detail')

@section('content')

<x-common.component-card title="Order Detail">

    {{-- HEADER --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <p class="text-sm text-text-muted">
                Order ID
            </p>
            <p class="font-mono text-sm">
                {{ $order->order_number }}
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}"
           class="btn-admin">
            ← Back
        </a>
    </div>

    {{-- ORDER SUMMARY --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

        <div class="rounded-lg border border-border-soft p-4">
            <p class="text-xs text-text-muted">Customer</p>
            <p class="font-medium">{{ $order->user->name }}</p>
            <p class="text-xs text-text-muted">
                {{ $order->user->city ?? '-' }}
            </p>
        </div>

        <div class="rounded-lg border border-border-soft p-4">
            <p class="text-xs text-text-muted">Total</p>
            <p class="font-semibold">
                Rp {{ number_format($order->total) }}
            </p>
        </div>

        <div class="rounded-lg border border-border-soft p-4">
            <p class="text-xs text-text-muted">Payment Status</p>

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
        </div>

    </div>

    {{-- ITEMS TABLE --}}
    <h3 class="mb-3 text-sm font-semibold">
        Ordered Products
    </h3>

    <div class="overflow-x-auto mb-8">
        <table class="admin-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td class="text-text-muted">
                            {{ $loop->iteration }}
                        </td>

                        <td class="font-medium">
                            {{ $item->product->name }}
                        </td>

                        <td>
                            Rp {{ number_format($item->price) }}
                        </td>

                        <td>
                            {{ $item->quantity }}
                        </td>

                        <td class="font-semibold">
                            Rp {{ number_format($item->price * $item->quantity) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    {{-- MIDTRANS INFO --}}
    <h3 class="mb-3 text-sm font-semibold">
        Payment Information
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="rounded-lg border border-border-soft p-4">
            <p class="text-xs text-text-muted">Transaction ID</p>
            <p class="font-mono text-sm">
                {{ $order->midtrans_transaction_id ?? '-' }}
            </p>
        </div>

        <div class="rounded-lg border border-border-soft p-4">
            <p class="text-xs text-text-muted">Created At</p>
            <p class="text-sm">
                {{ $order->created_at->format('d M Y H:i') }}
            </p>
        </div>

    </div>

</x-common.component-card>

@endsection
