<!-- resources/views/pages/admin/products/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<x-common.component-card title="Products">

    <div class="mb-4 flex items-center justify-between">
        <span class="text-sm text-gray-500">Manage products</span>

        <a href="{{ route('admin.products.create') }}"
           class="rounded-lg bg-btn-primary px-4 py-2 text-sm font-medium text-btn-text hover:bg-btn-primary-hover">
            + New Product
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-3 text-left">Image</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Price</th>
                    <th class="px-4 py-3 text-left">Order</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr class="border-b align-top">

                        <td class="px-4 py-3">
                            @if ($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}"
                                     class="h-12 w-16 rounded object-cover">
                            @else
                                <span class="text-xs text-gray-400">No image</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 font-medium">
                            {{ $product->name }}
                        </td>

                        <td class="px-4 py-3">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $product->order ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            @if ($product->is_active)
                                <span class="rounded bg-green-100 px-2 py-1 text-xs text-green-700">
                                    Active
                                </span>
                            @else
                                <span class="rounded bg-gray-200 px-2 py-1 text-xs text-gray-700">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="rounded-md bg-btn-primary px-3 py-1.5 text-xs text-btn-text">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.products.destroy', $product) }}"
                                      onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-md bg-danger px-3 py-1.5 text-xs text-white">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            No products found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>

</x-common.component-card>

@endsection
