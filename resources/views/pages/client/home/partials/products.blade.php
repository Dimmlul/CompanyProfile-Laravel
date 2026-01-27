<!-- resources/views/pages/client/home/partials/products.blade.php -->

<section class="py-16 bg-app-bg">
    <div class="mx-auto max-w-7xl px-6">

        {{-- HEADER --}}
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-app-text">
                Products
            </h2>

            <a href="{{ route('products') }}"
               class="text-sm text-app-muted hover:text-app-text transition">
                View All →
            </a>
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse ($products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="group overflow-hidden
                          rounded-xl border border-card-border
                          bg-card transition
                          hover:shadow-lg">

                    {{-- IMAGE --}}
                    <div class="h-52 w-full overflow-hidden">
                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            alt="{{ $product->name }}"
                            class="h-full w-full object-cover
                                   transition-transform duration-300
                                   group-hover:scale-105"
                        >
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-5">

                        <h3 class="text-lg font-semibold text-app-text">
                            {{ $product->name }}
                        </h3>

                        @if (!empty($product->excerpt))
                            <p class="mt-1 text-sm text-app-muted">
                                {{ $product->excerpt }}
                            </p>
                        @endif

                        {{-- PRICE (optional tapi cakep) --}}
                        @if (!empty($product->price))
                            <div class="mt-4 text-sm font-semibold text-app-text">
                                Rp {{ number_format($product->price) }}
                            </div>
                        @endif

                    </div>

                </a>
            @empty
                <div class="col-span-full text-center text-app-muted">
                    No products available.
                </div>
            @endforelse

        </div>

    </div>
</section>
