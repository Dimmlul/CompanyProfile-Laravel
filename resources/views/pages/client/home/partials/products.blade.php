<section class="bg-app-bg py-24 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">

        <div x-data x-reveal class="mb-14 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
            <div class="max-w-xl">
                <span class="eyebrow">What we offer</span>
                <h2 class="section-title">Products &amp; services</h2>
                <p class="section-subtitle">
                    Digital solutions built to support growth, performance, and long-term scalability.
                </p>
            </div>
            <a href="{{ route('products') }}" class="btn-ghost btn-sm self-start sm:self-auto">
                View all products &rarr;
            </a>
        </div>

        <div x-data x-reveal class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="group surface surface-hover flex flex-col overflow-hidden rounded-2xl hover:-translate-y-1">

                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                             class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        @if (filled($product->price))
                            <span class="absolute left-4 top-4 rounded-full border border-white/15 bg-black/50 px-3 py-1 text-xs font-medium text-white backdrop-blur">
                                Rp {{ number_format($product->price) }}
                            </span>
                        @endif
                    </div>

                    <div class="flex flex-1 flex-col p-6">
                        <h3 class="text-lg font-semibold leading-snug text-app-heading">{{ $product->name }}</h3>
                        @if (filled($product->excerpt))
                            <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-app-muted">{{ $product->excerpt }}</p>
                        @endif
                        <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-medium text-brand-accent transition group-hover:gap-2.5">
                            View details
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </div>
                </a>
            @empty
                <div class="surface col-span-full rounded-2xl py-16 text-center text-app-muted">
                    No products available yet.
                </div>
            @endforelse
        </div>
    </div>
</section>
