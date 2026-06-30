@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- ================= HERO ================= --}}
<section class="relative isolate overflow-hidden bg-app-bg glow-top">
    <div class="absolute inset-0 -z-10 bg-grid [mask-image:radial-gradient(ellipse_at_top,black,transparent_70%)]"></div>

    <div class="mx-auto max-w-3xl px-6 pt-32 text-center lg:pt-40">
        <span x-data x-reveal class="eyebrow">About us</span>
        <h1 x-data x-reveal="{ delay: 80 }"
            class="text-4xl font-semibold tracking-tight text-app-heading sm:text-5xl lg:text-6xl">
            {{ $companyProfile->company_name ?? 'Our Company' }}
        </h1>
        <p x-data x-reveal="{ delay: 160 }" class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-app-muted">
            {!! nl2br(e(
                $companyProfile->about ??
                'A digital studio building meaningful, scalable products for teams that care about doing things well.'
            )) !!}
        </p>
    </div>

    {{-- Wide banner --}}
    <div class="mx-auto mt-16 max-w-7xl px-6 lg:mt-20">
        <div x-data x-reveal class="overflow-hidden rounded-3xl border border-app-border">
            <img src="{{ asset('images/hero.jpg') }}" alt="{{ $companyProfile->company_name ?? 'Our work' }}"
                 class="aspect-[21/9] w-full object-cover">
        </div>
    </div>
</section>


{{-- ================= STORY ================= --}}
<section class="bg-app-bg py-24 lg:py-28">
    <div class="mx-auto grid max-w-7xl gap-10 px-6 lg:grid-cols-12 lg:gap-16">
        <div x-data x-reveal class="lg:col-span-4">
            <span class="eyebrow">Our story</span>
            <h2 class="section-title">Who we are</h2>
        </div>

        <div x-data x-reveal class="lg:col-span-8">
            <p class="text-xl leading-relaxed text-app-text">
                {!! nl2br(e(
                    $companyProfile->who_we_are ??
                    'We are a multidisciplinary studio that partners with businesses to design, build, and scale digital products. We bring together strategy, design, and engineering to ship work that solves real problems — and keeps working long after launch.'
                )) !!}
            </p>
        </div>
    </div>
</section>


{{-- ================= VISION & MISSION ================= --}}
<section class="bg-app-bg pb-24 lg:pb-28">
    <div class="mx-auto max-w-7xl px-6">
        <div class="border-t border-app-border pt-16">
            <div class="grid gap-12 md:grid-cols-2 md:gap-0 md:divide-x md:divide-app-border">
                <div x-data x-reveal class="md:pr-14">
                    <span class="text-sm font-semibold uppercase tracking-widest text-brand-accent">Vision</span>
                    <p class="mt-5 text-2xl font-medium leading-snug text-app-heading">
                        {{ $companyProfile->vision
                            ?? 'To be a trusted digital partner that helps businesses grow through purposeful, lasting technology.' }}
                    </p>
                </div>

                <div x-data x-reveal="{ delay: 100 }" class="md:pl-14">
                    <span class="text-sm font-semibold uppercase tracking-widest text-brand-accent">Mission</span>
                    <p class="mt-5 text-2xl font-medium leading-snug text-app-heading">
                        {{ $companyProfile->mission
                            ?? 'To design and build digital products that solve real problems and deliver meaningful, long-term value.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ================= CTA + CONTACT ================= --}}
<x-cta eyebrow="Say hello"
       title="Let's build something together"
       subtitle="Tell us about your project — we'll get back to you within one business day.">
    <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
        <a href="{{ route('contact') }}" class="btn-primary btn-lg">Start a conversation</a>
        <a href="{{ route('products') }}" class="btn-outline btn-lg">See our work</a>
    </div>

    @if (filled($companyProfile->email) || filled($companyProfile->phone))
        <div class="mt-8 flex flex-wrap items-center justify-center gap-x-8 gap-y-2 text-sm text-app-muted">
            @if (filled($companyProfile->email))
                <a href="mailto:{{ $companyProfile->email }}" class="transition hover:text-app-heading">{{ $companyProfile->email }}</a>
            @endif
            @if (filled($companyProfile->phone))
                <a href="tel:{{ $companyProfile->phone }}" class="transition hover:text-app-heading">{{ $companyProfile->phone }}</a>
            @endif
            @if (filled($companyProfile->address))
                <span>{{ $companyProfile->address }}</span>
            @endif
        </div>
    @endif
</x-cta>

@endsection
