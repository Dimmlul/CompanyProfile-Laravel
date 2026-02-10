@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<x-common.component-card title="Products">

    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-text-muted">
            Manage products
        </p>

        <a href="{{ route('admin.products.create') }}" class="btn-primary">
            + New Product
        </a>
    </div>

    {{-- TABLE COMPONENT --}}
    <x-admin.product.table :products="$products" />

    <div class="mt-4">
        {{ $products->links() }}
    </div>

</x-common.component-card>

@endsection
