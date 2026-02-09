<!-- resources/views/components/admin/orders/summary.blade.php -->

@props(['order'])

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    {{-- CUSTOMER --}}
    <div class="rounded-lg border border-border-soft p-4">
        <p class="text-xs text-text-muted">Customer</p>
        <p class="font-medium">{{ $order->user->name }}</p>
        <p class="text-sm">{{ $order->customer_email }}</p>
    </div>

    {{-- TOTAL --}}
    <div class="rounded-lg border border-border-soft p-4">
        <p class="text-xs text-text-muted">Total</p>
        <p class="font-semibold">
            Rp {{ number_format($order->total) }}
        </p>
    </div>

    {{-- STATUS --}}
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
