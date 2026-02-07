{{-- ================= VISION, MISSION & ADVANTAGES ================= --}}
<section
    x-data="scrollProgress"
    class="relative bg-gradient-to-b from-slate-900/40 to-transparent overflow-hidden"
>
    <div class="mx-auto max-w-7xl px-6 py-28">

        {{-- HEADER --}}
        <div
            :style="`
                opacity: ${progress};
                transform: translateY(${(1 - progress) * 40}px);
            `"
            class="mb-16 max-w-3xl transition-[opacity,transform] duration-200"
        >
            <span class="mb-3 inline-block text-xs font-semibold uppercase tracking-widest text-indigo-400">
                Direction & Values
            </span>

            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-white">
                Vision, Mission & Our Strengths
            </h2>

            <p class="mt-4 text-app-muted leading-relaxed">
                Our vision and mission guide every decision we make.
            </p>
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 gap-16 lg:grid-cols-3">

            {{-- VISION --}}
            <div
                :style="`
                    opacity: ${Math.min(progress * 1.2, 1)};
                    transform:
                        translateY(${(1 - progress) * 60}px)
                        scale(${0.96 + progress * 0.04});
                `"
                class="transition-[opacity,transform] duration-200"
            >
                <div class="relative rounded-2xl bg-slate-900/60 border border-white/10 p-10 h-full">
                    <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-indigo-500"></span>
                    <h3 class="mb-4 text-xl font-semibold text-white">Our Vision</h3>
                    <p class="text-app-muted leading-relaxed">
                        {{ $companyProfile->vision }}
                    </p>
                </div>
            </div>

            {{-- MISSION --}}
            <div
                :style="`
                    opacity: ${Math.min((progress - 0.1) * 1.3, 1)};
                    transform:
                        translateY(${(1 - progress) * 70}px)
                        scale(${0.96 + progress * 0.04});
                `"
                class="transition-[opacity,transform] duration-200"
            >
                <div class="relative rounded-2xl bg-slate-900/60 border border-white/10 p-10 h-full">
                    <span class="absolute left-0 top-0 h-full w-1 rounded-l-2xl bg-cyan-400"></span>
                    <h3 class="mb-4 text-xl font-semibold text-white">Our Mission</h3>
                    <p class="text-app-muted leading-relaxed">
                        {{ $companyProfile->mission }}
                    </p>
                </div>
            </div>

            {{-- ADVANTAGES --}}
            <div
                :style="`
                    opacity: ${Math.min((progress - 0.2) * 1.4, 1)};
                    transform:
                        translateY(${(1 - progress) * 80}px)
                        scale(${0.96 + progress * 0.04});
                `"
                class="transition-[opacity,transform] duration-200"
            >
                <div class="rounded-2xl bg-slate-900/60 border border-white/10 p-10 h-full">
                    <h3 class="mb-6 text-xs font-semibold uppercase tracking-widest text-indigo-400">
                        Our Advantages
                    </h3>

                    <ul class="space-y-6 text-sm text-app-muted">
                        <li><span class="text-white font-medium">Thoughtful Execution</span></li>
                        <li><span class="text-white font-medium">Scalable by Design</span></li>
                        <li><span class="text-white font-medium">Long-Term Partnership</span></li>
                        <li><span class="text-white font-medium">Clear Communication</span></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
