@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')

<x-common.component-card title="Create Product">

    {{-- FORM COMPONENT --}}
    <x-admin.product.form
        :action="route('admin.products.store')"
    />

</x-common.component-card>

@endsection
