@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- ================= HERO ================= --}}
<section class="relative bg-app-bg border-b border-app-border">
    <div class="mx-auto max-w-7xl px-6 py-24">
        <div class="grid grid-cols-1 items-center gap-12 md:grid-cols-2">

            {{-- LEFT : TEXT --}}
            <div class="max-w-3xl">
                <span class="eyebrow">About Us</span>
                <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-app-heading">
                    {{ $companyProfile->company_name ?? 'Our Company' }}
                </h1>
                <p class="mt-6 text-base leading-relaxed text-app-muted">
                    {!! nl2br(e(
                        $companyProfile->about ??
                        'We are a digital studio focused on building meaningful and scalable digital solutions that support long-term business growth.'
                    )) !!}
                </p>
            </div>

            {{-- RIGHT : LOGO --}}
            <div class="flex justify-center md:justify-end">
                @if(!empty($companyProfile->logo))
                    <div class="surface flex h-40 w-40 items-center justify-center rounded-2xl p-6">
                        <img src="{{ asset('storage/' . $companyProfile->logo) }}"
                             alt="{{ $companyProfile->company_name }} Logo"
                             class="max-h-full max-w-full object-contain">
                    </div>
                @else
                    <div class="surface flex h-40 w-40 items-center justify-center rounded-2xl text-sm text-app-muted">
                        Company Logo
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>


{{-- ================= WHO WE ARE ================= --}}
<section class="bg-app-bg">
    <div class="mx-auto max-w-7xl px-6 py-24">
        <div class="grid grid-cols-1 gap-12 md:grid-cols-3">

            {{-- Main --}}
            <div class="surface md:col-span-2 rounded-2xl p-10">
                <h2 class="mb-6 text-2xl font-semibold text-app-heading">Who We Are</h2>
                <p class="leading-relaxed text-app-muted">
                    {!! nl2br(e(
                        $companyProfile->who_we_are ??
                        'We are a multidisciplinary digital studio that collaborates with businesses to design, build, and scale digital products. Our team combines strategic thinking, design excellence, and technical expertise to deliver solutions that solve real-world challenges.'
                    )) !!}
                </p>
            </div>

            {{-- Focus --}}
            <div class="surface rounded-2xl p-8">
                <h3 class="mb-6 text-xs font-semibold uppercase tracking-widest text-brand-accent">Our Focus</h3>
                <ul class="space-y-6 text-sm text-app-muted">
                    @foreach ([
                        ['Scalable Systems', 'We build systems designed to grow, focusing on performance, security, and maintainable architecture.'],
                        ['User-Centered Design', 'Every interface is crafted with clarity, usability, and accessibility as top priorities.'],
                        ['Long-Term Strategy', 'We help businesses make digital decisions that remain effective beyond short-term trends.'],
                    ] as [$title, $desc])
                        <li class="flex gap-4">
                            <span class="mt-1 h-2 w-2 flex-none rounded-full bg-brand-accent"></span>
                            <div>
                                <span class="block font-medium text-app-heading">{{ $title }}</span>
                                {{ $desc }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ================= VISION & MISSION ================= --}}
<section class="bg-app-bg">
    <div class="mx-auto max-w-7xl px-6 py-24">
        <h2 class="mb-12 text-3xl font-semibold text-app-heading">Vision &amp; Mission</h2>

        <div class="grid grid-cols-1 gap-10 md:grid-cols-2">
            <div class="surface relative rounded-2xl p-10">
                <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-brand-main"></span>
                <h3 class="mb-4 text-xl font-semibold text-app-heading">Vision</h3>
                <p class="leading-relaxed text-app-muted">
                    {!! nl2br(e(
                        $companyProfile->vision ??
                        'To become a trusted digital partner that empowers businesses through purposeful, adaptable, and sustainable technology solutions.'
                    )) !!}
                </p>
            </div>

            <div class="surface relative rounded-2xl p-10">
                <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-cyan-500"></span>
                <h3 class="mb-4 text-xl font-semibold text-app-heading">Mission</h3>
                <p class="leading-relaxed text-app-muted">
                    {!! nl2br(e(
                        $companyProfile->mission ??
                        'Our mission is to design and develop digital products that solve real business challenges while delivering meaningful user experiences and long-term value.'
                    )) !!}
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ================= COMPANY INFO ================= --}}
<section class="bg-app-bg">
    <div class="mx-auto max-w-7xl px-6 py-24">
        <h2 class="mb-10 text-3xl font-semibold text-app-heading">Company Information</h2>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
            @php
                $items = [
                    ['label' => 'Address', 'value' => $companyProfile->address ?? null],
                    ['label' => 'Phone', 'value' => $companyProfile->phone ?? null],
                    ['label' => 'Fax', 'value' => $companyProfile->fax ?? null],
                    ['label' => 'Email', 'value' => $companyProfile->email ?? null],
                ];
            @endphp

            @foreach ($items as $item)
                @if ($item['value'])
                    <div class="surface rounded-xl p-6">
                        <span class="mb-2 block text-xs font-semibold uppercase tracking-widest text-brand-accent">
                            {{ $item['label'] }}
                        </span>
                        <p class="text-sm text-app-muted">{{ $item['value'] }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

@endsection
