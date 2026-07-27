{{-- Admin: edit a gallery image. --}}
@extends('layouts.admin')

@section('title', 'Edit Gallery')

@section('content')

<x-common.component-card title="Edit Gallery Image">

    {{-- ALERT --}}
    <x-common.alert />
    <x-common.alert type="success" />

    {{-- FORM COMPONENT --}}
    <x-admin.gallery.form
        :action="route('admin.gallery.update', $gallery)"
        method="PUT"
        :gallery="$gallery"
        showOrder
    />

</x-common.component-card>

@endsection
