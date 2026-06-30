<section class="bg-app-bg py-24 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">

        <div x-data x-reveal class="mb-14 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
            <x-section-heading
                eyebrow="What we offer"
                title="Products & services"
                subtitle="Digital solutions built to support growth, performance, and long-term scalability." />
            <a href="{{ route('products') }}" class="btn-ghost btn-sm self-start sm:self-auto">
                View all products &rarr;
            </a>
        </div>

        <div x-data x-reveal class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="surface col-span-full rounded-2xl py-16 text-center text-app-muted">
                    No products available yet.
                </div>
            @endforelse
        </div>
    </div>
</section>
