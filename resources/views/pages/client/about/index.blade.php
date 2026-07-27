{{-- About page: company story, vision and mission, contact CTA. --}}
@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- ================= HERO ================= --}}
<section class="relative isolate overflow-hidden bg-app-bg glow-top">
    <div class="absolute inset-0 -z-10 bg-grid [mask-image:radial-gradient(ellipse_at_top,black,transparent_70%)]"></div>

    <div class="mx-auto max-w-7xl px-6 pt-20 pb-16 lg:py-16">
        <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center lg:gap-16">

            {{-- Copy --}}
            <div>
                <span x-data x-reveal class="eyebrow">About us</span>
                <h1 x-data x-reveal="{ delay: 80 }"
                    class="mt-4 text-4xl font-semibold leading-[1.05] tracking-tight text-app-heading sm:text-5xl lg:text-6xl">
                    {{ $companyProfile->company_name ?? 'Our Company' }}
                </h1>
                <p x-data x-reveal="{ delay: 160 }" class="mt-6 max-w-xl text-lg leading-relaxed text-app-muted">
                    {!! nl2br(e(
                        $companyProfile->about ??
                        'A digital studio building meaningful, scalable products for teams that care about doing things well.'
                    )) !!}
                </p>
                <div x-data x-reveal="{ delay: 240 }" class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}" class="btn-primary btn-lg">Work with us</a>
                    <a href="{{ route('products') }}" class="btn-outline btn-lg">See our work</a>
                </div>
            </div>

            {{-- Real gallery shot; boxed at 4:3 to match typical landscape photo framing so object-cover doesn't crop too aggressively --}}
            <div x-data x-reveal="{ delay: 200 }" class="relative mx-auto w-full max-w-lg lg:ml-auto lg:mr-0">
                <div class="absolute -inset-6 -z-10 rounded-[2rem] bg-gradient-to-tr from-brand-main/20 via-transparent to-transparent blur-2xl"></div>
                <div class="overflow-hidden rounded-2xl border border-app-border shadow-2xl">
                    <img src="{{ $aboutImage ? asset('storage/'.$aboutImage) : asset('images/hero.jpg') }}"
                         alt="{{ $companyProfile->company_name ?? 'Our team' }}"
                         class="aspect-[4/3] w-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ================= STORY ================= --}}
<section class="bg-app-bg py-20 lg:py-24">
    <div class="mx-auto max-w-4xl px-6">
        <p x-data x-reveal class="text-xl leading-relaxed text-app-text sm:text-2xl">
            {!! nl2br(e(
                $companyProfile->who_we_are ??
                'We are a multidisciplinary studio that partners with businesses to design, build, and scale digital products. We bring together strategy, design, and engineering to ship work that solves real problems — and keeps working long after launch.'
            )) !!}
        </p>

        {{-- Vision as a pull quote breaking up the narrative, editorial-style --}}
        <blockquote x-data x-reveal class="my-12 border-l-2 border-brand-main pl-6 lg:my-16 lg:pl-8">
            <p class="text-2xl font-medium leading-snug text-app-heading sm:text-3xl">
                {{ $companyProfile->vision
                    ?? 'To be a trusted digital partner that helps businesses grow through purposeful, lasting technology.' }}
            </p>
            <cite class="mt-4 block text-sm not-italic text-app-muted">&mdash; Our vision</cite>
        </blockquote>

        <p x-data x-reveal class="text-lg leading-relaxed text-app-muted">
            {{ $companyProfile->mission
                ?? 'To design and build digital products that solve real problems and deliver meaningful, long-term value.' }}
        </p>
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
