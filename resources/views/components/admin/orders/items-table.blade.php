<!-- resources/views/components/admin/orders/items-table.blade.php -->

@props(['items'])

<x-common.table.simple
    :headers="['#', 'Product', 'Price', 'Qty', 'Subtotal']"
>
    @foreach ($items as $item)
        <tr>
            <td class="text-text-muted">
                {{ $loop->iteration }}
            </td>

            <td class="font-medium">
                {{ $item->product->name }}
            </td>

            <td>
                Rp {{ number_format($item->price) }}
            </td>

            <td>
                {{ $item->qty }}
            </td>

            <td class="font-semibold">
                Rp {{ number_format($item->total) }}
            </td>
        </tr>
    @endforeach
</x-common.table.simple>
