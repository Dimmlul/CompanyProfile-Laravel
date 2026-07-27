{{-- Dashboard widget: table of the most recent orders with payment status and a link to each. --}}
@props(['orders'])

<div class="surface rounded-2xl p-6">

    {{-- HEADER --}}
    <div class="mb-5 flex items-center justify-between">
        <h2 class="text-sm font-semibold text-app-heading">Recent orders</h2>
        <x-common.button.link :href="route('admin.orders.index')">View all</x-common.button.link>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($orders as $order)
                    {{-- Pick a badge color based on the order's payment status. --}}
                    @php
                        $statusClass = match ($order->payment_status) {
                            'paid'              => 'bg-green-500/15 text-green-600 dark:text-green-400',
                            'pending'           => 'bg-yellow-500/15 text-yellow-600 dark:text-yellow-400',
                            'failed', 'expired' => 'bg-red-500/15 text-red-600 dark:text-red-400',
                            default             => 'bg-app-surface-2 text-app-muted',
                        };
                    @endphp
                    <tr>
                        <td class="font-mono text-xs">{{ $order->order_number }}</td>
                        <td>{{ $order->user->name ?? '-' }}</td>
                        <td>
                            @foreach ($order->items as $item)
                                <div class="text-app-muted">
                                    <span class="text-app-text">{{ $item->product->name }}</span>
                                    <span class="text-xs">&times;{{ $item->qty }}</span>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClass }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td class="text-right">
                            <x-common.button.link :href="route('admin.orders.show', $order)">View</x-common.button.link>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="admin-table-empty">No recent orders</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
