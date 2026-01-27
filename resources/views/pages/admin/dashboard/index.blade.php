<!-- resources/views/pages/admin/dashboard/index.blade.php -->

@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<h1 class="mb-6 text-xl font-semibold text-app-text">
    Dashboard
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Articles -->
    <div class="bg-dashboard-card border border-dashboard-card-border rounded-xl p-6">
        <p class="text-sm text-dashboard-card-muted">Articles</p>
        <p class="mt-2 text-2xl font-semibold text-dashboard-card-text">
            {{ $totalArticles }}
        </p>
        <p class="mt-1 text-xs text-dashboard-card-muted">
            Published: {{ $publishedArticles }}
        </p>
    </div>

    <!-- Products -->
    <div class="bg-dashboard-card border border-dashboard-card-border rounded-xl p-6">
        <p class="text-sm text-dashboard-card-muted">Products</p>
        <p class="mt-2 text-2xl font-semibold text-dashboard-card-text">
            {{ $totalProducts }}
        </p>
        <p class="mt-1 text-xs text-dashboard-card-muted">
            Active: {{ $activeProducts }}
        </p>
    </div>

    <!-- Events -->
    <div class="bg-dashboard-card border border-dashboard-card-border rounded-xl p-6">
        <p class="text-sm text-dashboard-card-muted">Events</p>
        <p class="mt-2 text-2xl font-semibold text-dashboard-card-text">
            {{ $totalEvents }}
        </p>
        <p class="mt-1 text-xs text-dashboard-card-muted">
            Active: {{ $activeEvents }}
        </p>
    </div>

    <!-- Gallery -->
    <div class="bg-dashboard-card border border-dashboard-card-border rounded-xl p-6">
        <p class="text-sm text-dashboard-card-muted">Gallery</p>
        <p class="mt-2 text-2xl font-semibold text-dashboard-card-text">
            {{ $totalGalleries }}
        </p>
        <p class="mt-1 text-xs text-dashboard-card-muted">
            Total images
        </p>
    </div>

    <!-- Clients -->
    <div class="bg-dashboard-card border border-dashboard-card-border rounded-xl p-6">
        <p class="text-sm text-dashboard-card-muted">Clients</p>
        <p class="mt-2 text-2xl font-semibold text-dashboard-card-text">
            {{ $totalClients }}
        </p>
        <p class="mt-1 text-xs text-dashboard-card-muted">
            Total partners
        </p>
    </div>

</div>

@endsection
