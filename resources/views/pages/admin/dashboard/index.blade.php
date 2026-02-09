@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

{{-- =========================================================
| HEADER
========================================================= --}}
<div class="mb-12">
    <h1 class="text-2xl font-semibold tracking-tight text-app-text">
        Dashboard
    </h1>
    <p class="mt-1 text-sm text-app-muted">
        Overview of content, activity, and recent orders
    </p>
</div>

{{-- =========================================================
| CONTENT CARDS (FLAT • DARK • PREMIUM)
========================================================= --}}
@php
    $card = '
        bg-dashboard-card
        border border-dashboard-card-border
        rounded-2xl
        p-6
        flex flex-col
        transition
        hover:bg-white/[0.015]
    ';

    $iconWrap = '
        flex h-11 w-11 items-center justify-center
        rounded-lg
        bg-[var(--color-brand-soft)]
        text-primary
    ';

    $title = 'text-sm font-medium text-dashboard-card-muted';
    $value = 'mt-4 text-3xl font-semibold tracking-tight text-dashboard-card-text';
    $actions = 'mt-auto pt-6 flex items-center justify-between';
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- ARTICLES --}}
    <div class="{{ $card }}">
        <div class="flex items-center gap-4">
            <div class="{{ $iconWrap }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4z"/>
                </svg>
            </div>
            <div>
                <p class="{{ $title }}">Articles</p>
                <p class="text-xs text-dashboard-card-muted">
                    Total Article : {{ $totalArticles }}
                </p>
            </div>
        </div>

        <p class="{{ $value }}">
            {{ $publishedArticles }}
        </p>

        <div class="{{ $actions }}">
            <x-admin.quick-add type="article" label="+ Add"/>
            <a href="{{ route('admin.articles.index') }}" class="btn-admin">View all</a>
        </div>
    </div>

    {{-- PRODUCTS --}}
    <div class="{{ $card }}">
        <div class="flex items-center gap-4">
            <div class="{{ $iconWrap }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 16V8l-9-5-9 5v8l9 5 9-5z"/>
                </svg>
            </div>
            <div>
                <p class="{{ $title }}">Products</p>
                <p class="text-xs text-dashboard-card-muted">
                    Total Product : {{ $totalProducts }}
                </p>
            </div>
        </div>

        <p class="{{ $value }}">
             {{ $activeProducts }}
        </p>

        <div class="{{ $actions }}">
            <x-admin.quick-add type="product" label="+ Add"/>
            <a href="{{ route('admin.products.index') }}" class="btn-admin">View all</a>
        </div>
    </div>

    {{-- EVENTS --}}
    <div class="{{ $card }}">
        <div class="flex items-center gap-4">
            <div class="{{ $iconWrap }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3M5 11h14"/>
                </svg>
            </div>
            <div>
                <p class="{{ $title }}">Events</p>
                <p class="text-xs text-dashboard-card-muted">
                    Total Events : {{ $totalEvents }}
                </p>
            </div>
        </div>

        <p class="{{ $value }}">
             {{ $activeEvents }}
        </p>

        <div class="{{ $actions }}">
            <x-admin.quick-add type="event" label="+ Add"/>
            <a href="{{ route('admin.events.index') }}" class="btn-admin">View all</a>
        </div>
    </div>

    {{-- GALLERY --}}
    <div class="{{ $card }}">
        <div class="flex items-center gap-4">
            <div class="{{ $iconWrap }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 16l4-4a3 3 0 014 0l4 4"/>
                </svg>
            </div>
            <div>
                <p class="{{ $title }}">Gallery</p>
                <p class="text-xs text-dashboard-card-muted">
                    Total Gallery : {{ $totalGalleries }}
                </p>
            </div>
        </div>

        <p class="{{ $value }}">
        {{ $activeGalleries }}
        </p>

        <div class="{{ $actions }}">
            <x-admin.quick-add type="gallery" label="+ Add"/>
            <a href="{{ route('admin.gallery.index') }}" class="btn-admin">View all</a>
        </div>
    </div>

    {{-- CLIENTS --}}
    <div class="{{ $card }}">
        <div class="flex items-center gap-4">
            <div class="{{ $iconWrap }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m4-4a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <p class="{{ $title }}">Clients</p>
                <p class="text-xs text-dashboard-card-muted">
                    Total Clients : {{ $totalClients }}
                </p>
            </div>
        </div>

        <p class="{{ $value }}">
            {{ $activeClients }}
        </p>

        <div class="{{ $actions }}">
            <x-admin.quick-add type="client" label="+ Add"/>
            <a href="{{ route('admin.clients.index') }}" class="btn-admin">View all</a>
        </div>
    </div>

</div>

{{-- =========================================================
| SPACER
========================================================= --}}
<div class="h-24"></div>

{{-- =========================================================
| RECENT ORDERS (SAME STYLE AS CARD)
========================================================= --}}
<div class="bg-dashboard-card border border-dashboard-card-border rounded-2xl p-6">

    <div class="mb-4 flex items-center justify-between">
        <div>
            <h3 class="text-base font-medium text-dashboard-card-text">
                Recent Orders
            </h3>
            <p class="text-sm text-dashboard-card-muted">
                Latest transactions
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="btn-admin">
            View all
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="admin-table">

            <thead>
                <tr>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($recentOrders as $order)

                    @php
                        $items = $order->items ?? collect();
                        $firstProduct = $items->first();
                    @endphp

                    <tr>
                        <td class="font-medium">
                            {{ $order->order_number }}
                            <div class="text-xs text-text-muted">
                                {{ $order->created_at->format('d M Y') }}
                            </div>
                        </td>

                        <td>{{ $order->user->name ?? 'Guest' }}</td>

                        <td>
                            @if ($firstProduct)
                                <span class="font-medium">
                                    {{ $firstProduct->product_name }}
                                </span>
                                @if ($items->count() > 1)
                                    <span class="text-xs text-text-muted">
                                        +{{ $items->count() - 1 }} more
                                    </span>
                                @endif
                            @else
                                <span class="text-xs text-text-muted">No product</span>
                            @endif
                        </td>

                        <td class="font-medium">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </td>

                        <td>
                            @if ($order->payment_status === 'paid')
                                <span class="badge badge-success">Paid</span>
                            @elseif ($order->payment_status === 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @else
                                <span class="badge badge-danger">Failed</span>
                            @endif
                        </td>

                        <td class="text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn-admin">
                                View
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="admin-table-empty">
                            No recent orders
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection
