<!-- resources/views/components/admin/orders/payment-info.blade.php -->

@props(['order'])

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
