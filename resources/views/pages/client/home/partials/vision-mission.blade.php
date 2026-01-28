<section class="py-24 bg-app-bg">
    <div class="mx-auto max-w-6xl px-6">

        {{-- SECTION HEADER --}}
        <div class="mb-16 text-center">
            <h2 class="text-3xl font-semibold text-app-text">
                Vision & Mission
            </h2>
            <p class="mt-3 text-sm text-app-muted max-w-xl mx-auto">
                Our direction, values, and commitment in building impactful digital solutions.
            </p>
        </div>

        @if ($companyProfile)

            <div class="grid gap-10 md:grid-cols-2">

                {{-- VISION --}}
                @if ($companyProfile->vision)
                    <div
                        class="relative rounded-2xl
                               border border-white/10
                               bg-[rgba(255,255,255,0.03)]
                               p-8
                               transition
                               hover:border-white/20"
                    >
                        {{-- Accent line --}}
                        <div class="absolute left-0 top-8 h-12 w-1 rounded-r
                                    bg-[var(--color-brand-main)]"></div>

                        <h3 class="mb-4 text-lg font-semibold text-app-text">
                            Vision
                        </h3>

                        <p class="text-app-muted leading-relaxed">
                            {{ $companyProfile->vision }}
                        </p>
                    </div>
                @endif

                {{-- MISSION --}}
                @if ($companyProfile->mission)
                    <div
                        class="relative rounded-2xl
                               border border-white/10
                               bg-[rgba(255,255,255,0.03)]
                               p-8
                               transition
                               hover:border-white/20"
                    >
                        {{-- Accent line --}}
                        <div class="absolute left-0 top-8 h-12 w-1 rounded-r
                                    bg-[var(--color-brand-main)]"></div>

                        <h3 class="mb-4 text-lg font-semibold text-app-text">
                            Mission
                        </h3>

                        <p class="text-app-muted leading-relaxed whitespace-pre-line">
                            {{ $companyProfile->mission }}
                        </p>
                    </div>
                @endif

            </div>

        @else
            <p class="mt-6 text-center text-app-muted">
                Company profile has not been set yet.
            </p>
        @endif

    </div>
</section>
