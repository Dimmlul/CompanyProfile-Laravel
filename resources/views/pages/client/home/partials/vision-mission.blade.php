<section class="bg-app-bg py-24 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">

        <div x-data x-reveal class="mb-14 max-w-2xl">
            <span class="eyebrow">What drives us</span>
            <h2 class="section-title">Built on a clear direction</h2>
            <p class="section-subtitle">
                The principles behind every project we take on — from first call to final handover.
            </p>
        </div>

        {{-- Bento: tiles of different sizes for a more editorial layout --}}
        <div x-data x-reveal class="grid gap-4 md:grid-cols-3 md:grid-rows-2">

            {{-- Vision (wide) --}}
            <article class="surface surface-hover rounded-2xl p-8 md:col-span-2">
                <div class="mb-5 flex items-center gap-3">
                    <span class="text-xs font-semibold tracking-widest text-brand-accent">01</span>
                    <span class="h-px flex-1 bg-app-border"></span>
                    <span class="text-xs uppercase tracking-widest text-app-muted">Vision</span>
                </div>
                <h3 class="mb-3 text-2xl font-semibold text-app-heading">Where we're headed</h3>
                <p class="max-w-2xl leading-relaxed text-app-muted">{{ $companyProfile->vision }}</p>
            </article>

            {{-- Strengths (tall, right column) --}}
            <article class="surface surface-hover rounded-2xl p-8 md:row-span-2">
                <div class="mb-6 flex items-center gap-3">
                    <span class="text-xs font-semibold tracking-widest text-brand-accent">03</span>
                    <span class="h-px flex-1 bg-app-border"></span>
                    <span class="text-xs uppercase tracking-widest text-app-muted">Strengths</span>
                </div>
                <ul class="space-y-5">
                    @foreach (['Thoughtful execution', 'Scalable by design', 'Long-term partnership', 'Clear communication'] as $strength)
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-5 w-5 flex-none text-brand-accent" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm font-medium text-app-heading">{{ $strength }}</span>
                        </li>
                    @endforeach
                </ul>
            </article>

            {{-- Mission (wide) --}}
            <article class="surface surface-hover rounded-2xl p-8 md:col-span-2">
                <div class="mb-5 flex items-center gap-3">
                    <span class="text-xs font-semibold tracking-widest text-brand-accent">02</span>
                    <span class="h-px flex-1 bg-app-border"></span>
                    <span class="text-xs uppercase tracking-widest text-app-muted">Mission</span>
                </div>
                <h3 class="mb-3 text-2xl font-semibold text-app-heading">What we do every day</h3>
                <p class="max-w-2xl leading-relaxed text-app-muted">{{ $companyProfile->mission }}</p>
            </article>
        </div>
    </div>
</section>
