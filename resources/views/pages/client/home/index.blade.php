@extends('layouts.app')

@section('title', 'Home')

@section('content')

    {{-- HERO --}}
    @include('pages.client.home.partials.hero')

    {{-- GALLERY CAROUSEL --}}
    @include('pages.client.home.partials.gallery-carousel', [
        'galleries' => $galleries
    ])

    {{-- PRODUCTS --}}
    @include('pages.client.home.partials.products', [
        'products' => $products
    ])

    {{-- CLIENTS --}}
    @include('pages.client.home.partials.clients', [
        'clients' => $clients
    ])

    {{-- VISION & MISSION --}}
    @include('pages.client.home.partials.vision-mission')

    {{-- CONTACT --}}
    @include('pages.client.home.partials.contact')

@endsection
