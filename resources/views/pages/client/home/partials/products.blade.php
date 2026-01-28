<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-7xl px-6">

        {{-- HEADER --}}
        <div class="mb-12 flex items-end justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-white">
                    Products
                </h2>
                <p class="mt-1 text-sm text-app-muted">
                    Selected digital products and services from our studio
                </p>
            </div>

            <a href="{{ route('products') }}"
               class="inline-flex items-center gap-1 text-sm text-app-muted
                      hover:text-white transition">
                View all
                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                     stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">

            @forelse ($products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="group relative overflow-hidden rounded-2xl
                          border border-white/10
                          bg-gradient-to-b from-slate-800/60 to-slate-900/80
                          transition-all duration-300
                          hover:-translate-y-1 hover:shadow-xl">

                    {{-- IMAGE --}}
                    <div class="relative h-52 overflow-hidden">
                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            alt="{{ $product->name }}"
                            class="h-full w-full object-cover
                                   transition-transform duration-500
                                   group-hover:scale-105"
                        >

                        {{-- overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t
                                    from-app-bg/70 via-transparent to-transparent">
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6">

                        <h3 class="text-lg font-semibold text-white">
                            {{ $product->name }}
                        </h3>

                        @if (!empty($product->excerpt))
                            <p class="mt-2 text-sm leading-relaxed text-app-muted">
                                {{ $product->excerpt }}
                            </p>
                        @endif

                        <div class="mt-6 flex items-center justify-between">

                            @if (!empty($product->price))
                                <span class="text-sm font-semibold text-white">
                                    Rp {{ number_format($product->price) }}
                                </span>
                            @else
                                <span></span>
                            @endif

                            <span class="inline-flex items-center gap-1
                                         text-sm text-app-muted
                                         transition group-hover:text-white">
                                View detail
                                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                     stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>

                        </div>
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
