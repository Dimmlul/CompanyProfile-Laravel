{{-- Landing section: hover-expand gallery carousel highlighting selected work. --}}
<section class="bg-app-bg py-24 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">

        <div x-data x-reveal class="mb-12 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
            <x-section-heading
                eyebrow="Selected work"
                title="A look at what we've made"
                subtitle="Recent projects we're proud of." />
            <a href="{{ route('gallery') }}" class="btn-ghost btn-sm self-start sm:self-auto">
                View full gallery >
            </a>
        </div>

        {{--
            Mobile/tablet: a swipeable snap-scroll carousel — hover-expand doesn't work on
            touch, so every panel used to stay equally (and uselessly) narrow.
            Desktop (lg+): panels grow on hover, as before.
        --}}
        <div x-data x-reveal
             class="no-scrollbar -mx-6 flex snap-x snap-mandatory gap-4 overflow-x-auto px-6 pb-2
                    lg:mx-0 lg:h-[440px] lg:snap-none lg:overflow-visible lg:px-0 lg:pb-0">
            @foreach ($galleries as $gallery)
                <div class="group relative h-72 w-[80%] flex-none snap-start overflow-hidden rounded-2xl
                            border border-app-border transition-all duration-500 ease-out
                            sm:w-[46%]
                            lg:h-full lg:w-auto lg:flex-1 lg:hover:flex-[3]">
                    <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}"
                         class="h-full w-full object-cover transition-transform duration-700 lg:group-hover:scale-105">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>

                    <div class="absolute inset-x-0 bottom-0 p-5 sm:p-6 lg:p-8">
                        <span class="text-xs uppercase tracking-widest text-brand-accent
                                     lg:opacity-0 lg:transition-opacity lg:duration-300 lg:group-hover:opacity-100">
                            Featured
                        </span>
                        <h3 class="mt-1 text-lg font-semibold leading-tight text-white sm:text-xl lg:text-2xl">
                            {{ $gallery->title }}
                        </h3>
                        @if (filled($gallery->caption))
                            <p class="mt-2 max-w-md text-sm text-white/70
                                      lg:opacity-0 lg:transition-opacity lg:delay-75 lg:duration-300 lg:group-hover:opacity-100">
                                {{ $gallery->caption }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
