<!-- resources/views/pages/admin/dashboard/index.blade.php -->

@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mt-4">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-xl font-semibold text-app-text mb-8">
            Dashboard
        </h1>
        <p class="text-sm text-app-muted mb-6">
            Overview of content, activity, and recent orders
        </p>
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

        {{-- ARTICLES --}}
        <x-admin.dashboard.stat-card
            title="Articles"
            subtitle="Published {{ $publishedArticles }} / {{ $totalArticles }}"
            :value="$totalArticles"
        >
            <x-slot:icon>📄</x-slot:icon>

            <x-slot:viewAll>
                <x-common.button.link :href="route('admin.articles.index')">
                    View all
                </x-common.button.link>
            </x-slot:viewAll>

            <x-slot:action>
                <x-admin.dashboard.quick-add
                    type="article"
                    label="Article"
                />
            </x-slot:action>
        </x-admin.dashboard.stat-card>

        {{-- PRODUCTS --}}
        <x-admin.dashboard.stat-card
            title="Products"
            subtitle="Active {{ $activeProducts }} / {{ $totalProducts }}"
            :value="$totalProducts"
        >
            <x-slot:icon>📦</x-slot:icon>

            <x-slot:viewAll>
                <x-common.button.link :href="route('admin.products.index')">
                    View all
                </x-common.button.link>
            </x-slot:viewAll>

            <x-slot:action>
                <x-admin.dashboard.quick-add
                    type="product"
                    label="Product"
                />
            </x-slot:action>
        </x-admin.dashboard.stat-card>

        {{-- EVENTS --}}
        <x-admin.dashboard.stat-card
            title="Events"
            subtitle="Active {{ $activeEvents }} / {{ $totalEvents }}"
            :value="$totalEvents"
        >
            <x-slot:icon>📅</x-slot:icon>

            <x-slot:viewAll>
                <x-common.button.link :href="route('admin.events.index')">
                    View all
                </x-common.button.link>
            </x-slot:viewAll>

            <x-slot:action>
                <x-admin.dashboard.quick-add
                    type="event"
                    label="Event"
                />
            </x-slot:action>
        </x-admin.dashboard.stat-card>

        {{-- GALLERIES --}}
        <x-admin.dashboard.stat-card
            title="Galleries"
            subtitle="Active {{ $activeGalleries }}"
            :value="$totalGalleries"
        >
            <x-slot:icon>🖼️</x-slot:icon>

            <x-slot:viewAll>
                <x-common.button.link :href="route('admin.gallery.index')">
                    View all
                </x-common.button.link>
            </x-slot:viewAll>

            <x-slot:action>
                <x-admin.dashboard.quick-add
                    type="gallery"
                    label="Gallery"
                />
            </x-slot:action>
        </x-admin.dashboard.stat-card>

        {{-- CLIENTS --}}
        <x-admin.dashboard.stat-card
            title="Clients"
            subtitle="Active {{ $activeClients }} / {{ $totalClients }}"
            :value="$totalClients"
        >
            <x-slot:icon>👥</x-slot:icon>

            <x-slot:viewAll>
                <x-common.button.link :href="route('admin.clients.index')">
                    View all
                </x-common.button.link>
            </x-slot:viewAll>

            <x-slot:action>
                <x-admin.dashboard.quick-add
                    type="client"
                    label="Client"
                />
            </x-slot:action>
        </x-admin.dashboard.stat-card>

    </div>

    {{-- RECENT ORDERS --}}
    <div class="pt-17">
        <x-admin.dashboard.recent-orders :orders="$recentOrders" />
    </div>

</div>
@endsection
