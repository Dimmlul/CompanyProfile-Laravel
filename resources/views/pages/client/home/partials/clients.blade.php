<section
    x-data
    x-reveal
    class="py-28 bg-app-bg"
>
    <div class="mx-auto max-w-7xl px-6">

        {{-- ================= HEADER ================= --}}
        <div class="mb-16 text-center">
            <span class="mb-3 inline-block text-xs font-semibold uppercase tracking-widest text-indigo-400">
                Partnerships
            </span>

            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-white">
                Trusted by Our Clients
            </h2>

            <p class="mt-4 text-sm leading-relaxed text-app-muted max-w-xl mx-auto">
                We collaborate with startups, growing businesses, and established
                organizations to deliver reliable and impactful digital solutions.
            </p>
        </div>

        {{-- ================= CLIENT GRID ================= --}}
        <div
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4
                   gap-x-10 gap-y-14"
        >
            @foreach ($clients as $client)
                <div
                    class="group
                           aspect-[3/2]
                           rounded-2xl
                           border border-white/10
                           bg-slate-900/40
                           p-3
                           transition-all duration-300
                           hover:border-white/25
                           hover:-translate-y-1"
                >
                    <div
                        class="relative h-full w-full
                               rounded-xl
                               bg-white/[0.03]
                               overflow-hidden
                               flex items-center justify-center"
                    >
                        <img
                            src="{{ asset('storage/'.$client->logo) }}"
                            alt="{{ $client->name }}"
                            class="h-[85%] w-[85%]
                                   object-contain
                                   opacity-80
                                   transition-all duration-300
                                   group-hover:opacity-100
                                   group-hover:scale-[1.05]"
                        >

                        {{-- subtle glow --}}
                        <span
                            class="pointer-events-none absolute inset-0
                                   opacity-0 group-hover:opacity-100
                                   transition
                                   bg-gradient-to-tr
                                   from-indigo-500/5 via-transparent to-transparent"
                        ></span>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
