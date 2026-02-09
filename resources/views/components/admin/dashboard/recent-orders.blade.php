<!-- resources/views/components/admin/dashboard/recent-orders.blade.php -->

@props(['orders'])

<div
    class="rounded-2xl border border-white/10
           bg-white/5 p-6 space-y-5"
>

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-semibold text-app-text">
            Recent Orders
        </h2>

        <x-common.button.link :href="route('admin.orders.index')">
            View all
        </x-common.button.link>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-app-muted">

            <thead>
                <tr
                    class="border-b border-white/10
                           text-left text-xs tracking-wide"
                >
                    <th class="py-3">Order</th>
                    <th>User</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-b border-white/5">

                        {{-- ORDER --}}
                        <td class="py-3 font-mono text-xs text-app-text">
                            {{ $order->order_number }}
                        </td>

                        {{-- USER --}}
                        <td class="text-app-text">
                            {{ $order->user->name ?? '-' }}
                        </td>

                        {{-- PRODUCTS --}}
                        <td class="space-y-1">
                            @foreach ($order->items as $item)
                                <div class="flex items-center gap-1">
                                    <span class="text-app-muted">•</span>
                                    <span class="text-app-text">
                                        {{ $item->product->name }}
                                    </span>
                                    <span class="text-xs text-app-muted">
                                        (x{{ $item->qty }})
                                    </span>
                                </div>
                            @endforeach
                        </td>

                        {{-- STATUS --}}
                        <td>
                            <span class="badge badge-muted">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>

                        {{-- ACTION --}}
                        <td class="text-right">
                            <x-common.button.link
                                :href="route('admin.orders.show', $order)"
                            >
                                View
                            </x-common.button.link>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td
                            colspan="5"
                            class="py-6 text-center text-app-muted"
                        >
                            No recent orders
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
