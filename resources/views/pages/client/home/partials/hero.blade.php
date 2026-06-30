@php
    // Use the newest gallery image as the hero visual, falling back to the static asset.
    $heroImage = optional($galleries->first())->image;
    $heroSrc = $heroImage ? asset('storage/'.$heroImage) : asset('images/hero.jpg');
@endphp

<section class="relative isolate overflow-hidden bg-app-bg glow-top">

    {{-- Faint blueprint grid, masked so it fades toward the edges --}}
    <div class="absolute inset-0 -z-10 bg-grid [mask-image:radial-gradient(ellipse_at_top,black,transparent_72%)]"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-16 px-6 pt-36 pb-24
                lg:grid-cols-[1.05fr_0.95fr] lg:pt-44 lg:pb-32">

        {{-- ============ LEFT: copy ============ --}}
        <div>
            <a href="{{ route('events') }}" x-data x-reveal
               class="group inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5
                      px-3 py-1 text-xs text-app-muted backdrop-blur transition hover:border-white/25">
                <span class="rounded-full bg-brand-main px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-white">New</span>
                See what we're building
                <svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5" fill="none"
                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <h1 x-data x-reveal="{ delay: 80 }"
                class="mt-6 text-4xl font-semibold leading-[1.05] tracking-tight text-white sm:text-5xl lg:text-[3.5rem]">
                We craft digital products that
                <span class="text-brand-accent">move brands forward</span>
            </h1>

            <p x-data x-reveal="{ delay: 160 }" class="mt-6 max-w-xl text-base leading-relaxed text-app-muted">
                {{ $companyProfile->about
                    ?? 'From idea to launch, we design and build modern, scalable products that help ambitious teams grow.' }}
            </p>

            <div x-data x-reveal="{ delay: 240 }" class="mt-9 flex flex-wrap items-center gap-3">
                <a href="{{ route('contact') }}" class="btn-primary btn-lg">Start a project</a>
                <a href="{{ route('products') }}" class="btn-outline btn-lg">Explore our work</a>
            </div>

            @if ($clients->isNotEmpty())
                <div x-data x-reveal="{ delay: 320 }" class="mt-14">
                    <p class="text-xs uppercase tracking-widest text-app-muted/70">Trusted by teams at</p>
                    <div class="mt-5 flex flex-wrap items-center gap-x-9 gap-y-5">
                        @foreach ($clients->take(5) as $client)
                            <img src="{{ asset('storage/'.$client->logo) }}" alt="{{ $client->name }}"
                                 class="h-7 w-auto opacity-50 grayscale transition duration-300 hover:opacity-100 hover:grayscale-0">
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- ============ RIGHT: framed visual ============ --}}
        <div x-data x-reveal="{ delay: 200 }" class="relative mx-auto w-full max-w-xl lg:mx-0">
            {{-- soft brand wash behind the frame --}}
            <div class="absolute -inset-6 -z-10 rounded-[2rem] bg-gradient-to-tr from-brand-main/25 via-transparent to-transparent blur-2xl"></div>

            <div class="relative overflow-hidden rounded-2xl border border-white/10 shadow-2xl">
                <img src="{{ $heroSrc }}" alt="{{ $companyProfile->company_name ?? 'Our work' }}"
                     class="aspect-[4/3] w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
            </div>

            {{-- availability chip --}}
            <div class="absolute -bottom-5 -left-5 flex items-center gap-2.5 rounded-xl border border-white/10
                        bg-slate-950/80 px-4 py-3 shadow-xl backdrop-blur">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400/70"></span>
                    <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-green-400"></span>
                </span>
                <span class="text-sm font-medium text-white">Available for new projects</span>
            </div>
        </div>
    </div>
</section>
