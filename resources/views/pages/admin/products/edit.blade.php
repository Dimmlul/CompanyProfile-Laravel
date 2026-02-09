@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')

<x-common.component-card title="Edit Product">

    <x-admin.product.form
        :action="route('admin.products.update', $product)"
        method="PUT"
        :product="$product"
        showOrder
    />

</x-common.component-card>

@endsection
