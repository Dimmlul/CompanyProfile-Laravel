<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-7xl px-6">
        <div class="rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 via-gray-900 to-slate-950
                    px-6 py-16 shadow-2xl md:px-12 md:py-20">

            <div x-data x-reveal class="mb-14 text-center">
                <span class="mb-3 inline-block text-xs font-semibold uppercase tracking-widest text-indigo-400">
                    Our work
                </span>
                <h2 class="text-3xl font-semibold tracking-tight text-white md:text-4xl">
                    Our latest creations
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-relaxed text-white/70">
                    A selection of recent projects we're proud of. Hover to take a closer look.
                </p>
            </div>

            {{-- Expanding panels: each item grows on hover (desktop) --}}
            <div class="mx-auto flex h-[420px] w-full max-w-5xl items-center gap-6">
                @foreach ($galleries as $gallery)
                    <div class="group relative h-full w-56 flex-grow overflow-hidden rounded-2xl
                                border border-white/10 transition-all duration-500 hover:w-full">
                        <img
                            src="{{ asset('storage/'.$gallery->image) }}"
                            alt="{{ $gallery->title }}"
                            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                        >
                        <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/40
                                    to-transparent p-10 text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            <h3 class="text-2xl font-semibold leading-tight">{{ $gallery->title }}</h3>
                            @if (filled($gallery->description))
                                <p class="mt-2 max-w-md text-sm text-white/80">{{ $gallery->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
