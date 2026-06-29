<section class="bg-app-bg py-28">
    <div class="mx-auto max-w-7xl px-6">

        <div x-data x-reveal class="mb-16 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
            <div class="max-w-xl">
                <span class="mb-3 inline-block text-xs font-semibold uppercase tracking-widest text-indigo-400">
                    What we offer
                </span>
                <h2 class="text-3xl font-semibold tracking-tight text-white md:text-4xl">
                    Products &amp; services
                </h2>
                <p class="mt-3 text-sm leading-relaxed text-app-muted">
                    Digital solutions built to support growth, performance, and long-term scalability.
                </p>
            </div>

            <a href="{{ route('products') }}" class="text-sm text-app-muted transition hover:text-white">
                View all products &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="group overflow-hidden rounded-2xl border border-white/10 bg-slate-900/60
                          transition-all duration-300 hover:-translate-y-1 hover:border-white/20">

                    <div class="relative h-56 overflow-hidden">
                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            alt="{{ $product->name }}"
                            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    </div>

                    <div class="p-7">
                        <h3 class="text-lg font-semibold leading-tight text-white">{{ $product->name }}</h3>

                        @if (filled($product->excerpt))
                            <p class="mt-3 text-sm leading-relaxed text-app-muted">{{ $product->excerpt }}</p>
                        @endif

                        <div class="mt-8 flex items-center justify-between">
                            @if (filled($product->price))
                                <span class="text-sm font-semibold text-white">Rp {{ number_format($product->price) }}</span>
                            @else
                                <span class="text-xs text-app-muted">Custom pricing</span>
                            @endif

                            <span class="text-sm font-medium text-indigo-400 transition group-hover:text-white">
                                View details &rarr;
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center text-app-muted">No products available yet.</div>
            @endforelse
        </div>
    </div>
</section>
