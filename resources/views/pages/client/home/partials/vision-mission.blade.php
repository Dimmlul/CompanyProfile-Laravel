<section class="bg-app-bg py-28">
    <div class="mx-auto max-w-7xl px-6">

        <div x-data x-reveal class="mb-16 max-w-3xl">
            <span class="mb-3 inline-block text-xs font-semibold uppercase tracking-widest text-indigo-400">
                Direction &amp; Values
            </span>
            <h2 class="text-3xl font-semibold tracking-tight text-white md:text-4xl">
                Vision, mission &amp; our strengths
            </h2>
            <p class="mt-4 leading-relaxed text-app-muted">
                The principles that guide every decision we make.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            {{-- Vision --}}
            <div x-data x-reveal class="relative h-full rounded-2xl border border-white/10 bg-slate-900/60 p-10">
                <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-indigo-500"></span>
                <h3 class="mb-4 text-xl font-semibold text-white">Our vision</h3>
                <p class="leading-relaxed text-app-muted">{{ $companyProfile->vision }}</p>
            </div>

            {{-- Mission --}}
            <div x-data x-reveal="{ delay: 100 }" class="relative h-full rounded-2xl border border-white/10 bg-slate-900/60 p-10">
                <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-cyan-400"></span>
                <h3 class="mb-4 text-xl font-semibold text-white">Our mission</h3>
                <p class="leading-relaxed text-app-muted">{{ $companyProfile->mission }}</p>
            </div>

            {{-- Strengths --}}
            <div x-data x-reveal="{ delay: 200 }" class="h-full rounded-2xl border border-white/10 bg-slate-900/60 p-10">
                <h3 class="mb-6 text-xs font-semibold uppercase tracking-widest text-indigo-400">Our strengths</h3>
                <ul class="space-y-4 text-sm text-app-muted">
                    <li class="text-white">Thoughtful execution</li>
                    <li class="text-white">Scalable by design</li>
                    <li class="text-white">Long-term partnership</li>
                    <li class="text-white">Clear communication</li>
                </ul>
            </div>
        </div>
    </div>
</section>
