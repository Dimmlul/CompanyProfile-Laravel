<section class="py-24 bg-app-bg">
    <div class="mx-auto max-w-7xl px-6">

        {{-- SECTION HEADER --}}
        <div class="mb-14 text-center">
            <h2 class="text-3xl font-semibold text-app-text">
                Trusted by Our Clients
            </h2>
            <p class="mt-3 text-sm text-app-muted max-w-xl mx-auto">
                We collaborate with startups, enterprises, and creative teams
                to deliver impactful digital solutions.
            </p>
        </div>

        {{-- CLIENT GRID --}}
        <div
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4
                   gap-x-10 gap-y-12"
        >
            @foreach ($clients as $client)
                <div
                    class="group
                           aspect-[3/2]
                           rounded-xl
                           border border-white/10
                           p-[6px]
                           transition
                           hover:border-white/25"
                >
                    <div
                        class="relative h-full w-full
                               rounded-lg
                               bg-[rgba(255,255,255,0.04)]
                               overflow-hidden
                               flex items-center justify-center"
                    >
                        <img
                            src="{{ asset('storage/'.$client->logo) }}"
                            alt="{{ $client->name }}"
                            class="h-[90%] w-[90%]
                                   object-contain
                                   transition
                                   opacity-90
                                   group-hover:opacity-100
                                   group-hover:scale-[1.03]"
                        >
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
