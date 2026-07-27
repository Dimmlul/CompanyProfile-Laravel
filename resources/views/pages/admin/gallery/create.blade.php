{{-- Admin: add a gallery image. --}}
@extends('layouts.admin')

@section('title', 'Add Gallery')

@section('content')

<x-common.component-card title="Add Gallery">

    {{-- ALERT --}}
    <x-common.alert />
    <x-common.alert type="success" />

    {{-- FORM COMPONENT --}}
    <x-admin.gallery.form
        :action="route('admin.gallery.store')"
    />

</x-common.component-card>

@endsection
