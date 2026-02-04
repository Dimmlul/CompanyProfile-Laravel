{{-- ================= VISION, MISSION & ADVANTAGES ================= --}}
<section class="relative bg-gradient-to-b from-slate-900/40 to-transparent">
    <div class="mx-auto max-w-7xl px-6 py-28">

        {{-- Section Header --}}
        <div class="mb-16 max-w-3xl">
            <span class="mb-3 inline-block text-xs font-semibold uppercase tracking-widest text-indigo-400">
                Direction & Values
            </span>

            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-white">
                Vision, Mission & Our Strengths
            </h2>

            <p class="mt-4 text-app-muted leading-relaxed">
                Our vision and mission guide every decision we make, while our
                strengths define how we deliver value in every project.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-16 lg:grid-cols-3">

            {{-- ================= VISION ================= --}}
            <div class="lg:col-span-1 relative">
                <div class="relative rounded-2xl bg-slate-900/60 border border-white/10 p-10 h-full">
                    <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-indigo-500"></span>

                    <h3 class="mb-4 text-xl font-semibold text-white">
                        Our Vision
                    </h3>

                    <p class="leading-relaxed text-app-muted">
                        {{ $companyProfile->vision }}
                    </p>
                </div>
            </div>

            {{-- ================= MISSION ================= --}}
            <div class="lg:col-span-1 relative">
                <div class="relative rounded-2xl bg-slate-900/60 border border-white/10 p-10 h-full">
                    <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-cyan-400"></span>

                    <h3 class="mb-4 text-xl font-semibold text-white">
                        Our Mission
                    </h3>

                    <p class="leading-relaxed text-app-muted">
                        {{ $companyProfile->mission }}
                    </p>
                </div>
            </div>

            {{-- ================= ADVANTAGES ================= --}}
            <div class="lg:col-span-1">
                <div class="rounded-2xl bg-slate-900/60 border border-white/10 p-10 h-full">

                    <h3 class="mb-6 text-xs font-semibold uppercase tracking-widest text-indigo-400">
                        Our Advantages
                    </h3>

                    <ul class="space-y-6 text-sm text-app-muted">

                        <li class="flex gap-4">
                            <span class="mt-1 h-2 w-2 rounded-full bg-indigo-400"></span>
                            <div>
                                <span class="block font-medium text-white">
                                    Thoughtful Execution
                                </span>
                                We approach every project with clarity, structure,
                                and careful decision-making.
                            </div>
                        </li>

                        <li class="flex gap-4">
                            <span class="mt-1 h-2 w-2 rounded-full bg-indigo-400"></span>
                            <div>
                                <span class="block font-medium text-white">
                                    Scalable by Design
                                </span>
                                Our solutions are built to grow alongside your
                                business needs.
                            </div>
                        </li>

                        <li class="flex gap-4">
                            <span class="mt-1 h-2 w-2 rounded-full bg-indigo-400"></span>
                            <div>
                                <span class="block font-medium text-white">
                                    Long-Term Partnership
                                </span>
                                We focus on sustainable value, not short-term
                                delivery.
                            </div>
                        </li>

                        <li class="flex gap-4">
                            <span class="mt-1 h-2 w-2 rounded-full bg-indigo-400"></span>
                            <div>
                                <span class="block font-medium text-white">
                                    Clear Communication
                                </span>
                                Transparent process and consistent updates at
                                every stage.
                            </div>
                        </li>

                    </ul>

                </div>
            </div>

        </div>
    </div>
</section>
