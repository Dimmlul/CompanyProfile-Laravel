@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- ================= HERO ================= --}}
<section class="relative bg-app-bg border-b border-white/5">
    <div class="mx-auto max-w-7xl px-6 py-24">

        <div class="max-w-3xl">
            <span class="mb-4 inline-block text-sm font-medium tracking-wide text-indigo-400">
                About Us
            </span>

            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-white">
                {{ $companyProfile->company_name ?? 'Our Company' }}
            </h1>

            <p class="mt-6 text-base leading-relaxed text-app-muted">
                We design and build digital products that balance
                <span class="text-white font-medium">clarity</span>,
                <span class="text-white font-medium">performance</span>,
                and <span class="text-white font-medium">long-term vision</span>
                — helping brands grow with confidence.
            </p>
        </div>

    </div>
</section>

{{-- ================= WHO WE ARE ================= --}}
<section class="bg-app-bg">
    <div class="mx-auto max-w-7xl px-6 py-24">

        <div class="grid grid-cols-1 gap-12 md:grid-cols-3">

            {{-- Main --}}
            <div class="md:col-span-2 rounded-2xl bg-slate-900/60 border border-white/10 p-10">
                <h2 class="mb-6 text-2xl font-semibold text-white">
                    Who We Are
                </h2>

                <p class="leading-relaxed text-app-muted">
                    {{ $companyProfile->about }}
                </p>
            </div>

            {{-- Focus --}}
            <div class="rounded-2xl bg-slate-900/60 border border-white/10 p-8">
                <h3 class="mb-6 text-xs font-semibold uppercase tracking-widest text-indigo-400">
                    Our Focus
                </h3>

                <ul class="space-y-6 text-sm text-app-muted">

                    <li class="flex gap-4">
                        <span class="mt-1 h-2 w-2 rounded-full bg-indigo-400"></span>
                        <div>
                            <span class="block font-medium text-white">
                                Scalable Systems
                            </span>
                            Built with performance, security, and growth in mind.
                        </div>
                    </li>

                    <li class="flex gap-4">
                        <span class="mt-1 h-2 w-2 rounded-full bg-indigo-400"></span>
                        <div>
                            <span class="block font-medium text-white">
                                User-Centered Design
                            </span>
                            Interfaces that feel intuitive and purposeful.
                        </div>
                    </li>

                    <li class="flex gap-4">
                        <span class="mt-1 h-2 w-2 rounded-full bg-indigo-400"></span>
                        <div>
                            <span class="block font-medium text-white">
                                Long-Term Strategy
                            </span>
                            Digital decisions guided by clarity and sustainability.
                        </div>
                    </li>

                </ul>
            </div>

        </div>
    </div>
</section>

{{-- ================= VISION & MISSION ================= --}}
<section class="bg-gradient-to-b from-slate-900/40 to-transparent">
    <div class="mx-auto max-w-7xl px-6 py-24">

        <h2 class="mb-12 text-3xl font-semibold text-white">
            Vision & Mission
        </h2>

        <div class="grid grid-cols-1 gap-10 md:grid-cols-2">

            {{-- Vision --}}
            <div class="relative rounded-2xl bg-slate-900/60 border border-white/10 p-10">
                <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-indigo-500"></span>

                <h3 class="mb-4 text-xl font-semibold text-white">
                    Vision
                </h3>

                <p class="leading-relaxed text-app-muted">
                    {{ $companyProfile->vision }}
                </p>
            </div>

            {{-- Mission --}}
            <div class="relative rounded-2xl bg-slate-900/60 border border-white/10 p-10">
                <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-cyan-400"></span>

                <h3 class="mb-4 text-xl font-semibold text-white">
                    Mission
                </h3>

                <p class="leading-relaxed text-app-muted">
                    {{ $companyProfile->mission }}
                </p>
            </div>

        </div>
    </div>
</section>

{{-- ================= COMPANY INFO ================= --}}
<section class="bg-app-bg">
    <div class="mx-auto max-w-7xl px-6 py-24">

        <h2 class="mb-10 text-3xl font-semibold text-white">
            Company Information
        </h2>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-4">

            @php
                $items = [
                    ['label' => 'Address', 'value' => $companyProfile->address],
                    ['label' => 'Phone', 'value' => $companyProfile->phone],
                    ['label' => 'Fax', 'value' => $companyProfile->fax],
                    ['label' => 'Email', 'value' => $companyProfile->email],
                ];
            @endphp

            @foreach ($items as $item)
                @if ($item['value'])
                <div class="rounded-xl bg-slate-900/60 border border-white/10 p-6">
                    <span class="mb-2 block text-xs font-semibold uppercase tracking-widest text-indigo-400">
                        {{ $item['label'] }}
                    </span>
                    <p class="text-sm text-app-muted">
                        {{ $item['value'] }}
                    </p>
                </div>
                @endif
            @endforeach

        </div>
    </div>
</section>

@endsection
