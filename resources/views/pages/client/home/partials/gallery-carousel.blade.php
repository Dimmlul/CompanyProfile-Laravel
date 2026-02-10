<!-- ================= GALLERY SECTION ================= -->
<section class="relative py-24 overflow-hidden card-bg">
    <div class="mx-auto max-w-7xl px-6">

        {{-- CARD WRAPPER --}}
        <div
            class="relative rounded-3xl
                   bg-gradient-to-br
                   from-[#0F172A] via-[#111827] to-[#020617]
                   border border-white/10
                   px-6 py-16 md:px-12 md:py-20
                   shadow-[0_30px_80px_-20px_rgba(0,0,0,0.85)]"
        >

            {{-- Header --}}
            <div class="mb-14 text-center">
                <span
                    class="mb-3 inline-block
                           text-xs font-semibold uppercase tracking-widest
                           text-indigo-400"
                >
                    Documentation
                </span>

                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-white">
                    Our Latest Creations
                </h2>

                <p
                    class="mt-3 text-sm text-white/70
                           max-w-xl mx-auto leading-relaxed"
                >
                    A curated selection of our recent works — crafted with clarity,
                    intention, and a strong visual identity.
                </p>
            </div>

            {{-- Gallery --}}
            <div class="flex items-center gap-6
                        h-[420px] w-full
                        max-w-5xl mx-auto">

                @foreach ($galleries as $gallery)
                    <div
                        class="relative group flex-grow w-56 h-[420px]
                               transition-all duration-500 hover:w-full
                               rounded-2xl overflow-hidden
                               border border-white/10
                               bg-black/20"
                    >
                        {{-- Image --}}
                        <img
                            class="h-full w-full object-cover object-center
                                   transition-transform duration-700
                                   group-hover:scale-105"
                            src="{{ asset('storage/' . $gallery->image) }}"
                            alt="{{ $gallery->title }}"
                        >

                        {{-- Overlay --}}
                        <div
                            class="absolute inset-0 flex flex-col justify-end
                                   p-10 text-white
                                   bg-gradient-to-t
                                   from-black/80 via-black/40 to-transparent
                                   opacity-0 group-hover:opacity-100
                                   transition-all duration-300"
                        >
                            <span
                                class="mb-2 text-xs uppercase tracking-widest
                                       text-indigo-300"
                            >
                                Featured Work
                            </span>

                            <h3 class="text-2xl font-semibold leading-tight">
                                {{ $gallery->title }}
                            </h3>

                            @if (!empty($gallery->description))
                                <p class="mt-2 max-w-md text-sm text-white/80">
                                    {{ $gallery->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
