@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
    'href' => null,
    'label' => 'Get in touch',
])

{{-- Reusable closing call-to-action band. Pass buttons via the slot, or use :href for a default button. --}}
<section class="bg-app-bg py-24 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">
        <div x-data x-reveal
             class="surface relative isolate overflow-hidden rounded-3xl px-6 py-16 text-center md:px-12 md:py-20">

            <div class="absolute inset-0 -z-10 bg-grid [mask-image:radial-gradient(ellipse_at_center,black,transparent_75%)]"></div>
            <div class="absolute left-1/2 top-0 -z-10 h-64 w-[36rem] -translate-x-1/2 rounded-full bg-brand-main/20 blur-3xl"></div>

            @if ($eyebrow)
                <span class="eyebrow">{{ $eyebrow }}</span>
            @endif

            <h2 class="section-title mx-auto max-w-2xl">{{ $title }}</h2>

            @if ($subtitle)
                <p class="section-subtitle mx-auto max-w-xl text-base">{{ $subtitle }}</p>
            @endif

            @if (trim($slot) !== '')
                {{ $slot }}
            @elseif ($href)
                <div class="mt-10">
                    <a href="{{ $href }}" class="btn-primary btn-lg">{{ $label }}</a>
                </div>
            @endif
        </div>
    </div>
</section>
