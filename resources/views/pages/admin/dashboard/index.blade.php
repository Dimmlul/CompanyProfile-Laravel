@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

{{-- =========================================================
| HEADER
========================================================= --}}
<div class="mb-10">
    <h1 class="text-2xl font-semibold text-app-text">Dashboard</h1>
    <p class="mt-1 text-sm text-app-muted">
        Overview of content, activity, and recent orders
    </p>
</div>

{{-- =========================================================
| CONTENT CARDS
========================================================= --}}
@php
    $card = 'relative bg-dashboard-card border border-dashboard-card-border rounded-2xl p-6 flex flex-col';
    $iconWrap = 'flex h-12 w-12 items-center justify-center rounded-xl bg-[var(--color-brand-soft)]';
    $title = 'text-base font-semibold text-dashboard-card-text';
    $meta  = 'text-xs text-dashboard-card-muted';
    $value = 'mt-5 text-3xl font-bold text-dashboard-card-text';
    $actions = 'mt-auto pt-6 flex items-center justify-between';
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- ARTICLES --}}
    <div class="{{ $card }}">
        <div class="flex items-center gap-4">
            <div class="{{ $iconWrap }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.75"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 4h16v16H4z"/>
                </svg>
            </div>
            <div>
                <p class="{{ $title }}">Articles</p>
                <p class="{{ $meta }}">Published {{ $publishedArticles }}</p>
            </div>
        </div>

        <p class="{{ $value }}">{{ $totalArticles }}</p>

        <div class="{{ $actions }}">
            <x-admin.quick-add type="article" label="+ Add" />
            <a href="{{ route('admin.articles.index') }}"
               class="text-xs font-medium text-primary hover:underline">
                View all →
            </a>
        </div>
    </div>

    {{-- PRODUCTS --}}
    <div class="{{ $card }}">
        <div class="flex items-center gap-4">
            <div class="{{ $iconWrap }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.75"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 16V8l-9-5-9 5v8l9 5 9-5z"/>
                </svg>
            </div>
            <div>
                <p class="{{ $title }}">Products</p>
                <p class="{{ $meta }}">Active {{ $activeProducts }}</p>
            </div>
        </div>

        <p class="{{ $value }}">{{ $totalProducts }}</p>

        <div class="{{ $actions }}">
            <x-admin.quick-add type="product" label="+ Add" />
            <a href="{{ route('admin.products.index') }}"
               class="text-xs font-medium text-primary hover:underline">
                View all →
            </a>
        </div>
    </div>

    {{-- EVENTS --}}
    <div class="{{ $card }}">
        <div class="flex items-center gap-4">
            <div class="{{ $iconWrap }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.75"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3M5 11h14"/>
                </svg>
            </div>
            <div>
                <p class="{{ $title }}">Events</p>
                <p class="{{ $meta }}">Active {{ $activeEvents }}</p>
            </div>
        </div>

        <p class="{{ $value }}">{{ $totalEvents }}</p>

        <div class="{{ $actions }}">
            <x-admin.quick-add type="event" label="+ Add" />
            <a href="{{ route('admin.events.index') }}"
               class="text-xs font-medium text-primary hover:underline">
                View all →
            </a>
        </div>
    </div>

    {{-- GALLERY --}}
    <div class="{{ $card }}">
        <div class="flex items-center gap-4">
            <div class="{{ $iconWrap }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.75"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 16l4-4a3 3 0 014 0l4 4m-4-8h.01"/>
                </svg>
            </div>
            <div>
                <p class="{{ $title }}">Gallery</p>
                <p class="{{ $meta }}">Total images</p>
            </div>
        </div>

        <p class="{{ $value }}">{{ $totalGalleries }}</p>

        <div class="{{ $actions }}">
            <x-admin.quick-add type="gallery" label="+ Add" />
            <a href="{{ route('admin.gallery.index') }}"
               class="text-xs font-medium text-primary hover:underline">
                View all →
            </a>
        </div>
    </div>

    {{-- CLIENTS --}}
    <div class="{{ $card }}">
        <div class="flex items-center gap-4">
            <div class="{{ $iconWrap }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.75"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m4-4a4 4 0 11-8 0 4 4 0 018 0zm6 4a3 3 0 100-6 3 3 0 000 6z"/>
                </svg>
            </div>
            <div>
                <p class="{{ $title }}">Clients</p>
                <p class="{{ $meta }}">Business partners</p>
            </div>
        </div>

        <p class="{{ $value }}">{{ $totalClients }}</p>

        <div class="{{ $actions }}">
            <x-admin.quick-add type="client" label="+ Add" />
            <a href="{{ route('admin.clients.index') }}"
               class="text-xs font-medium text-primary hover:underline">
                View all →
            </a>
        </div>
    </div>

</div>

{{-- =========================================================
| VERTICAL SPACER (IMPORTANT)
========================================================= --}}
<div class="h-20"></div>

{{-- =========================================================
| RECENT ORDERS
========================================================= --}}
<div class="bg-dashboard-card border border-dashboard-card-border rounded-2xl">

    <div class="flex items-center justify-between px-6 py-5 border-b border-dashboard-card-border">
        <div class="flex items-center gap-3">
            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[var(--color-brand-soft)]">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 8h14l-1.5 12.5H6.5L5 8z"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-dashboard-card-text">Recent Orders</p>
                <p class="text-xs text-dashboard-card-muted">
                    Latest customer transactions
                </p>
            </div>
        </div>

        <a href="{{ route('admin.orders.index') }}"
           class="text-sm font-medium text-primary hover:underline">
            View all
        </a>
    </div>

    <div class="px-6 py-10 text-center text-dashboard-card-muted">
        No recent orders
    </div>

</div>

@endsection
