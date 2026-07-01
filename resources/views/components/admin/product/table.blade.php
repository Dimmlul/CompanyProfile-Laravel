@props(['products'])

@php use Illuminate\Support\Str; @endphp

<div class="overflow-x-auto">
    <table class="admin-table w-full">

        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
                <th>Order</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($products as $product)
                <tr>

                    <td>
                        @if ($product->image)
                            <img
                                src="{{ asset('storage/'.$product->image) }}"
                                class="h-12 w-16 rounded object-cover border border-app-border"
                            >
                        @else
                            <span class="text-xs text-app-muted">No image</span>
                        @endif
                    </td>

                    <td class="font-medium">
                        {{ $product->name }}
                    </td>

                    <td class="text-sm text-app-muted max-w-xs">
                        {{ Str::limit($product->description, 80) ?? '-' }}
                    </td>

                    <td>
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    <td>
                        @if ($product->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-muted">Inactive</span>
                        @endif
                    </td>

                    <td>{{ $product->order }}</td>

                    <td class="text-right">
                        <div class="inline-flex gap-2">
                            <a
                                href="{{ route('admin.products.edit', $product) }}"
                                class="btn-admin"
                            >
                                Edit
                            </a>

                            <form
                                method="POST"
                                action="{{ route('admin.products.destroy', $product) }}"
                                onsubmit="return confirm('Delete this product?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="admin-table-empty">
                        No products found
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>
