{{-- Admin page showing full detail for a single order: summary, items, and payment info. --}}
@extends('layouts.admin')

@section('title', 'Order Detail')

@section('content')

<x-common.component-card title="Order Detail">

    {{-- HEADER --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <p class="text-sm text-text-muted">Order ID</p>
            <p class="font-mono text-sm">
                {{ $order->order_number }}
            </p>
        </div>

        <x-common.button.back
            :href="route('admin.orders.index')"
        />
    </div>

    {{-- SUMMARY --}}
    <x-admin.orders.summary :order="$order" />

    {{-- ITEMS --}}
    <h3 class="mt-10 mb-3 text-sm font-semibold">
        Ordered Products
    </h3>

    <x-admin.orders.items-table
        :items="$order->items"
    />

    {{-- PAYMENT --}}
    <h3 class="mt-10 mb-3 text-sm font-semibold">
        Payment Information
    </h3>

    <x-admin.orders.payment-info
        :order="$order"
    />

</x-common.component-card>

@endsection
