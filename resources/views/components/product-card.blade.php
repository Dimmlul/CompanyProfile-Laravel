@props(['product'])

{{-- Reusable product card (landing, products grid + "other products"). --}}
<a href="{{ route('products.show', $product) }}"
   class="group surface surface-hover flex flex-col overflow-hidden rounded-2xl">

    <div class="relative aspect-[16/10] overflow-hidden">
        @if ($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
        @else
            <div class="flex h-full items-center justify-center bg-app-surface-2 text-sm text-app-muted">No image</div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/55 to-transparent"></div>

        @if (filled($product->price))
            <span class="absolute left-4 top-4 rounded-full border border-white/15 bg-black/50 px-3 py-1 text-xs font-medium text-white backdrop-blur">
                Rp {{ number_format($product->price) }}
            </span>
        @else
            <span class="absolute left-4 top-4 rounded-full border border-white/15 bg-black/50 px-3 py-1 text-xs font-medium text-white backdrop-blur">
                Custom pricing
            </span>
        @endif
    </div>

    <div class="flex flex-1 flex-col p-6">
        <h3 class="text-lg font-semibold leading-snug text-app-heading transition group-hover:text-brand-accent">
            {{ $product->name }}
        </h3>

        @if (filled($product->description))
            <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-app-muted">{{ $product->description }}</p>
        @endif

        <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-medium text-brand-accent transition group-hover:gap-2.5">
            View details
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </span>
    </div>
</a>
