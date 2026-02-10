@extends('layouts.app')

@section('title','Orders List')

@section('content')
<section class="py-16 bg-app-bg">
    <div class="max-w-6xl mx-auto px-6">

        <h1 class="text-2xl font-semibold text-white mb-8">
            Orders List
        </h1>

        {{-- CARD WRAPPER --}}
        <div class="bg-card border border-card-border rounded-2xl p-6">

            @if($orders->isEmpty())
                <div class="text-center text-app-muted py-16">
                    You don’t have any orders yet.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-separate border-spacing-y-3">

                        {{-- TABLE HEADER --}}
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

                                @php
                                    $expiredAt = $order->created_at->addMinutes(15);
                                    $isExpired = $order->payment_status === 'pending'
                                        && now()->greaterThan($expiredAt);

                                    $firstItem = $order->items->first();
                                @endphp

                                {{-- ROW --}}
                                <tr
                                    class="bg-app-bg/70 border border-card-border rounded-xl
                                           text-sm text-white">

                                    {{-- NO --}}
                                    <td class="px-4 py-4 font-medium">
                                        {{ $index + 1 }}.
                                    </td>

                                    {{-- PRODUCT --}}
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-4">
                                            <img
                                                src="{{ asset('storage/' . $firstItem->product->image) }}"
                                                class="w-14 h-14 rounded-lg object-cover border border-card-border"
                                                alt="{{ $firstItem->product->name }}">

                                            <div>
                                                <p class="font-medium">
                                                    {{ $firstItem->product->name }}
                                                    @if($firstItem->qty > 1)
                                                        <span class="text-indigo-400">
                                                            × {{ $firstItem->qty }}
                                                        </span>
                                                    @endif
                                                </p>
                                                <p class="text-xs text-app-muted">
                                                    {{ $order->order_number }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- CUSTOMER --}}
                                    <td class="px-4 py-4 text-app-muted">
                                        <p class="text-white font-medium">
                                            {{ auth()->user()->name }}
                                        </p>
                                    </td>

                                    {{-- TOTAL --}}
                                    <td class="px-4 py-4 font-semibold">
                                        Rp {{ number_format($order->total) }}
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-4 py-4">
                                        @if($order->payment_status === 'paid')
                                            <span class="px-3 py-1 rounded-full text-xs
                                                bg-green-500/20 text-green-400">
                                                Paid
                                            </span>
                                        @elseif($isExpired)
                                            <span class="px-3 py-1 rounded-full text-xs
                                                bg-red-500/20 text-red-400">
                                                Expired
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs
                                                bg-yellow-500/20 text-yellow-400">
                                                Pending
                                            </span>
                                        @endif
                                    </td>

                                    {{-- ACTION --}}
                                    <td class="px-4 py-4 text-right">
                                        @if($order->payment_status === 'paid')
                                            <a href="{{ route('orders.show', $order) }}"
                                               class="px-4 py-2 rounded-lg
                                                      bg-indigo-500 text-white
                                                      hover:bg-indigo-600 transition">
                                                View
                                            </a>
                                        @elseif($isExpired)
                                            <button disabled
                                                class="px-4 py-2 rounded-lg
                                                       bg-gray-600 text-gray-300 cursor-not-allowed">
                                                Expired
                                            </button>
                                        @else
                                            <a href="{{ route('checkout.payment', $order) }}"
                                               class="px-4 py-2 rounded-lg
                                                      bg-indigo-500 text-white
                                                      hover:bg-indigo-600 transition">
                                                Continue
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>

                    </table>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
