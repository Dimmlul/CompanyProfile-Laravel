@extends('layouts.app')

@section('title','Order Detail')

@section('content')
<section class="py-16 bg-app-bg">
    <div class="max-w-4xl mx-auto px-6">

        <h1 class="text-2xl font-semibold text-white mb-6">
            Order Detail
        </h1>

        {{-- ORDER INFO --}}
        <div class="bg-card border border-card-border rounded-xl p-6 mb-6">
            <p class="text-sm text-app-muted">Order ID</p>
            <p class="text-white font-medium mb-4">
                {{ $order->order_number }}
            </p>

            <p class="text-sm text-app-muted">Status</p>
            @if($order->payment_status === 'paid')
                <span class="inline-block mt-1 px-4 py-1 rounded-full
                    bg-green-500/20 text-green-400">
                    Paid
                </span>
            @elseif($order->payment_status === 'pending')
                <span class="inline-block mt-1 px-4 py-1 rounded-full
                    bg-yellow-500/20 text-yellow-400">
                    Pending
                </span>
            @else
                <span class="inline-block mt-1 px-4 py-1 rounded-full
                    bg-red-500/20 text-red-400">
                    Failed
                </span>
            @endif
        </div>

        {{-- ITEMS --}}
        <div class="bg-card border border-card-border rounded-xl p-6 mb-6">
            <h2 class="text-white font-semibold mb-4">Items</h2>

            <div class="space-y-3">
                @foreach($order->items as $item)
                    <div class="flex justify-between text-app-muted">
                        <span>
                            {{ $item->product->name }} × {{ $item->qty }}
                        </span>
                        <span>
                            Rp {{ number_format($item->price * $item->qty) }}
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="border-t border-card-border mt-4 pt-4
                        flex justify-between font-semibold text-white">
                <span>Total</span>
                <span>Rp {{ number_format($order->total) }}</span>
            </div>
        </div>

        {{-- CONTINUE PAYMENT --}}
        @if($order->payment_status !== 'paid')
            <div class="text-center">
                <a href="{{ route('checkout.payment', $order) }}"
                   class="inline-block px-8 py-3 rounded-xl
                          bg-indigo-500 text-white hover:bg-indigo-600 transition">
                    Continue Payment
                </a>
            </div>
        @endif

    </div>
</section>
@endsection
