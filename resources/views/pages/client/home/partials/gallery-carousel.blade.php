<section class="bg-app-bg py-24 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">

        <div x-data x-reveal class="mb-12 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
            <x-section-heading
                eyebrow="Selected work"
                title="A look at what we've made"
                subtitle="Recent projects we're proud of. Hover a panel to take a closer look." />
            <a href="{{ route('gallery') }}" class="btn-ghost btn-sm self-start sm:self-auto">
                View full gallery &rarr;
            </a>
        </div>

        {{-- Expanding panels: each grows on hover (desktop) --}}
        <div x-data x-reveal class="flex h-[300px] gap-3 sm:h-[440px] sm:gap-4">
            @foreach ($galleries as $gallery)
                <div class="group relative h-full flex-1 overflow-hidden rounded-2xl border border-app-border
                            transition-all duration-500 ease-out hover:flex-[3]">
                    <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}"
                         class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">

                    {{-- vertical label when collapsed, full caption when expanded --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>

                    <div class="absolute inset-x-0 bottom-0 p-5 sm:p-8">
                        <span class="text-xs uppercase tracking-widest text-brand-accent
                                     opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            Featured
                        </span>
                        <h3 class="mt-1 text-lg font-semibold leading-tight text-white sm:text-2xl">
                            {{ $gallery->title }}
                        </h3>
                        @if (filled($gallery->caption))
                            <p class="mt-2 max-w-md text-sm text-white/70 opacity-0 transition-opacity delay-75 duration-300 group-hover:opacity-100">
                                {{ $gallery->caption }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
