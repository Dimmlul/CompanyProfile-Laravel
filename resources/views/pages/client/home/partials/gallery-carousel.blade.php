<!-- Gallery Section -->
<section class="relative py-24 overflow-hidden bg-app-bg">
    <div class="mx-auto max-w-6xl px-6">

        {{-- Header --}}
        <div class="mb-12 text-center">
            <span class="mb-3 inline-block text-xs font-semibold uppercase tracking-widest text-indigo-400">
                Portfolio
            </span>

            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-white">
                Our Latest Creations
            </h2>

            <p class="mt-3 text-sm text-app-muted max-w-xl mx-auto leading-relaxed">
                A curated selection of our recent works — crafted with clarity,
                intention, and a strong visual identity.
            </p>
        </div>

        {{-- Gallery --}}
        <div class="flex items-center gap-6 h-[420px] w-full max-w-5xl mx-auto">

            @foreach ($galleries as $gallery)
                <div
                    class="relative group flex-grow w-56 h-[420px]
                           transition-all duration-500 hover:w-full
                           rounded-2xl overflow-hidden
                           border border-white/10"
                >
                    {{-- Image --}}
                    <img
                        class="h-full w-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                        src="{{ asset('storage/' . $gallery->image) }}"
                        alt="{{ $gallery->title }}"
                    >

                    {{-- Overlay --}}
                    <div
                        class="absolute inset-0 flex flex-col justify-end
                               p-10 text-white
                               bg-gradient-to-t from-black/80 via-black/40 to-transparent
                               opacity-0 group-hover:opacity-100
                               transition-all duration-300"
                    >
                        <h3 class="text-2xl font-semibold leading-tight">
                            {{ $gallery->title }}
                        </h3>

                        @if (!empty($gallery->description))
                            <p class="mt-2 max-w-md text-sm text-white/80">
                                {{ $gallery->description }}
                            </p>
                        @endif

                        <span class="mt-4 inline-block text-xs uppercase tracking-widest text-indigo-300">
                            View Project
                        </span>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</section>
