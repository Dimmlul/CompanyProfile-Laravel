{{-- Order detail page: shows purchased items, payment status and download/access links. --}}
@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
<section class="bg-app-bg py-20">
    <div class="mx-auto max-w-5xl px-6">

        {{-- HEADER --}}
        <div class="mb-10">
            <h1 class="text-2xl font-semibold text-app-heading">Order Detail</h1>
            <p class="mt-2 text-sm text-app-muted">Order ID: {{ $order->order_number }}</p>
        </div>

        {{-- STATUS --}}
        <div class="mb-6">
            @if($order->payment_status === 'paid')
                <span class="inline-flex rounded-full bg-green-500/20 px-4 py-1 text-sm text-green-500">Paid</span>
            @elseif($order->payment_status === 'pending')
                <span class="inline-flex rounded-full bg-yellow-500/20 px-4 py-1 text-sm text-yellow-600 dark:text-yellow-400">Pending</span>
            @else
                <span class="inline-flex rounded-full bg-red-500/20 px-4 py-1 text-sm text-red-500">Failed</span>
            @endif
        </div>

        {{-- ITEMS --}}
        <div class="space-y-6">
            @foreach($order->items as $item)
                @php $product = $item->product; @endphp

                <div class="surface rounded-2xl p-6">
                    <div class="flex gap-6">
                        <div class="shrink-0">
                            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/150' }}"
                                 class="h-24 w-24 rounded-xl border border-app-border object-cover" alt="{{ $product->name }}">
                        </div>

                        <div class="flex-1 space-y-2">
                            <h2 class="text-lg font-semibold text-app-heading">{{ $product->name }}</h2>
                            <p class="text-sm text-app-muted">Quantity: {{ $item->qty }}</p>
                            <p class="text-sm text-app-muted">Price: Rp {{ number_format($item->price) }}</p>

                            @if($order->payment_status === 'paid')
                                <div class="flex flex-wrap gap-3 pt-4">
                                    {{-- Both delivery types go through the gated download route (ownership + paid check) --}}
                                    @if($product->delivery_type === 'file' && $product->download_path)
                                        <a href="{{ route('orders.items.download', [$order, $item]) }}" class="btn-primary btn-sm">Download File</a>
                                    @elseif($product->delivery_type === 'link' && $product->download_url)
                                        <a href="{{ route('orders.items.download', [$order, $item]) }}" target="_blank" rel="noopener noreferrer" class="btn-primary btn-sm">Open Link</a>
                                    @else
                                        <span class="text-xs text-app-muted">Download not available yet</span>
                                    @endif
                                </div>
                            @else
                                <p class="pt-3 text-xs text-app-muted">Available after payment completed</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- TOTAL --}}
        <div class="mt-10 flex justify-between text-lg font-semibold text-app-heading">
            <span>Total</span>
            <span>Rp {{ number_format($order->total) }}</span>
        </div>
    </div>
</section>
@endsection
