@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
<section class="bg-app-bg py-20">
    <div class="max-w-5xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="mb-10">
            <h1 class="text-2xl font-semibold text-white">
                Order Detail
            </h1>
            <p class="mt-2 text-sm text-app-muted">
                Order ID: {{ $order->order_number }}
            </p>
        </div>

        {{-- STATUS --}}
        <div class="mb-6">
            @if($order->payment_status === 'paid')
                <span class="inline-flex px-4 py-1 rounded-full text-sm
                             bg-green-500/20 text-green-400">
                    Paid
                </span>
            @elseif($order->payment_status === 'pending')
                <span class="inline-flex px-4 py-1 rounded-full text-sm
                             bg-yellow-500/20 text-yellow-400">
                    Pending
                </span>
            @else
                <span class="inline-flex px-4 py-1 rounded-full text-sm
                             bg-red-500/20 text-red-400">
                    Failed
                </span>
            @endif
        </div>

        {{-- ITEMS --}}
        <div class="space-y-6">
            @foreach($order->items as $item)
                @php
                    $product = $item->product;
                @endphp

                <div class="bg-card border border-card-border rounded-2xl p-6">
                    <div class="flex gap-6">

                        {{-- IMAGE --}}
                        <div class="shrink-0">
                            <img
                                src="{{ $product->image
                                    ? asset('storage/'.$product->image)
                                    : 'https://via.placeholder.com/150' }}"
                                class="w-24 h-24 rounded-xl object-cover
                                       border border-card-border"
                                alt="{{ $product->name }}"
                            >
                        </div>

                        {{-- INFO --}}
                        <div class="flex-1 space-y-2">

                            <h2 class="text-lg font-semibold text-white">
                                {{ $product->name }}
                            </h2>

                            <p class="text-sm text-app-muted">
                                Quantity: {{ $item->qty }}
                            </p>

                            <p class="text-sm text-app-muted">
                                Price: Rp {{ number_format($item->price) }}
                            </p>

                            {{-- DOWNLOAD / LINK --}}
                            @if($order->payment_status === 'paid')
                                <div class="pt-4 flex flex-wrap gap-3">

                                    {{-- FILE DOWNLOAD --}}
                                    @if(
                                        $product->delivery_type === 'file'
                                        && $product->download_path
                                    )
                                        <a
                                            href="{{ asset('storage/'.$product->download_path) }}"
                                            download
                                            class="inline-flex items-center gap-2
                                                   px-4 py-2 rounded-lg
                                                   bg-indigo-500 text-white text-sm
                                                   hover:bg-indigo-600 transition"
                                        >
                                             Download File
                                        </a>

                                    {{-- LINK --}}
                                    @elseif(
                                        $product->delivery_type === 'link'
                                    )
                                        <a
                                            href="{{ $product->download_url ?? 'https://github.com/' }}"
                                            target="_blank"
                                            class="inline-flex items-center gap-2
                                                   px-4 py-2 rounded-lg
                                                   bg-indigo-500 text-white text-sm
                                                   hover:bg-indigo-600 transition"
                                        >
                                            Open Link
                                        </a>

                                    {{-- FALLBACK --}}
                                    @else
                                        <span class="text-xs text-app-muted">
                                            Download not available yet
                                        </span>
                                    @endif

                                </div>
                            @else
                                <p class="text-xs text-app-muted pt-3">
                                    Available after payment completed
                                </p>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- TOTAL --}}
        <div class="mt-10 flex justify-between text-lg font-semibold text-white">
            <span>Total</span>
            <span>Rp {{ number_format($order->total) }}</span>
        </div>

    </div>
</section>
@endsection
