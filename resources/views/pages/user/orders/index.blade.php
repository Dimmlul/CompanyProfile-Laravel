{{-- Order history list with payment status. --}}
@extends('layouts.app')

@section('title','Orders List')

@section('content')
<section class="bg-app-bg py-16">
    <div class="mx-auto max-w-6xl px-6">

        <h1 class="mb-8 text-2xl font-semibold text-app-heading">Orders List</h1>

        @if($orders->isEmpty())
            <x-empty-state
                icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                title="No orders yet"
                description="When you purchase a product, your orders will appear here.">
                <a href="{{ route('products') }}" class="btn-primary btn-sm">Browse products</a>
            </x-empty-state>
        @else
            <div class="surface rounded-2xl p-6">
                <div class="overflow-x-auto">
                    <table class="w-full border-separate border-spacing-y-3 text-left">
                        <thead>
                            <tr class="text-sm text-app-muted">
                                <th class="px-4">No</th>
                                <th class="px-4">Product</th>
                                <th class="px-4">Customer</th>
                                <th class="px-4">Total</th>
                                <th class="px-4">Status</th>
                                <th class="px-4 text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $index => $order)
                                {{-- A pending order expires 15 minutes after it was created --}}
                                @php
                                    $expiredAt = $order->created_at->addMinutes(15);
                                    $isExpired = $order->payment_status === 'pending' && now()->greaterThan($expiredAt);
                                    $firstItem = $order->items->first();
                                @endphp

                                <tr class="border border-app-border bg-app-surface-2 text-sm text-app-heading">
                                    <td class="px-4 py-4 font-medium">{{ $index + 1 }}.</td>

                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ asset('storage/' . $firstItem->product->image) }}"
                                                 class="h-14 w-14 rounded-lg border border-app-border object-cover"
                                                 alt="{{ $firstItem->product->name }}">
                                            <div>
                                                <p class="font-medium">
                                                    {{ $firstItem->product->name }}
                                                    @if($firstItem->qty > 1)
                                                        <span class="text-brand-accent">&times; {{ $firstItem->qty }}</span>
                                                    @endif
                                                </p>
                                                <p class="text-xs text-app-muted">{{ $order->order_number }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-4">
                                        <p class="font-medium text-app-heading">{{ auth()->user()->name }}</p>
                                    </td>

                                    <td class="px-4 py-4 font-semibold">Rp {{ number_format($order->total) }}</td>

                                    <td class="px-4 py-4">
                                        @if($order->payment_status === 'paid')
                                            <span class="rounded-full bg-green-500/20 px-3 py-1 text-xs text-green-500">Paid</span>
                                        @elseif($isExpired)
                                            <span class="rounded-full bg-red-500/20 px-3 py-1 text-xs text-red-500">Expired</span>
                                        @else
                                            <span class="rounded-full bg-yellow-500/20 px-3 py-1 text-xs text-yellow-600 dark:text-yellow-400">Pending</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4 text-right">
                                        @if($order->payment_status === 'paid')
                                            <a href="{{ route('orders.show', $order) }}" class="btn-primary btn-sm">View</a>
                                        @elseif($isExpired)
                                            <button disabled class="btn-sm cursor-not-allowed rounded-lg bg-app-surface px-4 py-2 text-app-muted">Expired</button>
                                        @else
                                            <a href="{{ route('checkout.payment', $order) }}" class="btn-primary btn-sm">Continue</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
