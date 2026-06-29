@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('pages.client.home.partials.hero')
    @include('pages.client.home.partials.vision-mission')
    @include('pages.client.home.partials.gallery-carousel')
    @include('pages.client.home.partials.products')
    @include('pages.client.home.partials.clients')
    @include('pages.client.home.partials.contact')

    <x-support-chat />
@endsection
