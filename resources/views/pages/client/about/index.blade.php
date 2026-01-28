@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- ================= HERO ================= --}}
<section class="relative bg-app-bg border-b border-white/5">
    <div class="mx-auto max-w-7xl px-6 py-24">

        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-white">
                About {{ $companyProfile->company_name ?? 'Our Company' }}
            </h1>

            <p class="mt-6 text-base leading-relaxed text-app-muted">
                We build thoughtful digital products that combine
                <span class="text-white font-medium">design</span>,
                <span class="text-white font-medium">technology</span>,
                and <span class="text-white font-medium">strategy</span>
                to help brands grow sustainably.
            </p>
        </div>

    </div>
</section>

{{-- ================= WHO WE ARE ================= --}}
<section class="bg-app-bg">
    <div class="mx-auto max-w-7xl px-6 py-24">

        <div class="grid grid-cols-1 gap-12 md:grid-cols-3">

            {{-- Main Description --}}
            <div class="md:col-span-2 rounded-2xl
                        bg-gradient-to-b from-slate-800/60 to-slate-900/70
                        border border-white/10 p-10">
                <h2 class="mb-5 text-2xl font-semibold text-white">
                    Who We Are
                </h2>

                <p class="leading-relaxed text-app-muted">
                    {{ $companyProfile->about }}
                </p>
            </div>

            {{-- Core Focus --}}
            <div class="rounded-2xl
                        bg-gradient-to-br from-indigo-900/40 to-slate-900/70
                        border border-indigo-400/10 p-8">
                <h3 class="mb-6 text-sm font-semibold uppercase tracking-widest text-indigo-300">
                    Our Core Focus
                </h3>

                <ul class="space-y-5 text-sm text-app-muted">

                    <li class="flex items-start gap-4">
                        <svg class="mt-0.5 h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 4h16v16H4z"/>
                        </svg>
                        <span>
                            <span class="text-white font-medium">Scalable Systems</span><br>
                            Built for performance, security, and growth.
                        </span>
                    </li>

                    <li class="flex items-start gap-4">
                        <svg class="mt-0.5 h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6v6l4 2"/>
                        </svg>
                        <span>
                            <span class="text-white font-medium">User-Centered Design</span><br>
                            Clean, intuitive, and accessible interfaces.
                        </span>
                    </li>

                    <li class="flex items-start gap-4">
                        <svg class="mt-0.5 h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 12l5 5L20 7"/>
                        </svg>
                        <span>
                            <span class="text-white font-medium">Long-Term Strategy</span><br>
                            Sustainable digital growth and clarity.
                        </span>
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
            <div class="relative rounded-2xl
                        bg-gradient-to-b from-slate-800/60 to-slate-900/70
                        border border-white/10 p-10">
                <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-indigo-500/60"></span>

                <h3 class="mb-4 text-xl font-semibold text-white">
                    Our Vision
                </h3>

                <p class="leading-relaxed text-app-muted">
                    {{ $companyProfile->vision }}
                </p>
            </div>

            {{-- Mission --}}
            <div class="relative rounded-2xl
                        bg-gradient-to-b from-slate-800/60 to-slate-900/70
                        border border-white/10 p-10">
                <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-cyan-400/60"></span>

                <h3 class="mb-4 text-xl font-semibold text-white">
                    Our Mission
                </h3>

                <p class="leading-relaxed text-app-muted">
                    {{ $companyProfile->mission }}
                </p>
            </div>

        </div>
    </div>
</section>

{{-- ================= COMPANY INFORMATION ================= --}}
<section class="bg-app-bg">
    <div class="mx-auto max-w-7xl px-6 py-24">

        <h2 class="mb-10 text-3xl font-semibold text-white">
            Company Information
        </h2>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-4">

            {{-- Address --}}
            <div class="rounded-xl bg-slate-900/60 border border-white/10 p-6">
                <div class="mb-3 flex items-center gap-3 text-indigo-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z"/>
                    </svg>
                    <span class="text-sm font-semibold uppercase">Address</span>
                </div>
                <p class="text-sm text-app-muted">{{ $companyProfile->address }}</p>
            </div>

            {{-- Phone --}}
            <div class="rounded-xl bg-slate-900/60 border border-white/10 p-6">
                <div class="mb-3 flex items-center gap-3 text-indigo-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 6.75c0 8.284 6.716 15 15 15"/>
                    </svg>
                    <span class="text-sm font-semibold uppercase">Phone</span>
                </div>
                <p class="text-sm text-app-muted">{{ $companyProfile->phone }}</p>
            </div>

            {{-- Fax --}}
            @if ($companyProfile->fax)
            <div class="rounded-xl bg-slate-900/60 border border-white/10 p-6">
                <div class="mb-3 flex items-center gap-3 text-indigo-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 12h12"/>
                    </svg>
                    <span class="text-sm font-semibold uppercase">Fax</span>
                </div>
                <p class="text-sm text-app-muted">{{ $companyProfile->fax }}</p>
            </div>
            @endif

            {{-- Email --}}
            <div class="rounded-xl bg-slate-900/60 border border-white/10 p-6">
                <div class="mb-3 flex items-center gap-3 text-indigo-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21.75 6.75l-9.75 6.75L2.25 6.75"/>
                    </svg>
                    <span class="text-sm font-semibold uppercase">Email</span>
                </div>
                <p class="text-sm text-app-muted">{{ $companyProfile->email }}</p>
            </div>

        </div>
    </div>
</section>

@endsection
