<section class="bg-app-bg py-28">
    <div class="mx-auto max-w-7xl px-6">

        <div x-data x-reveal class="mb-16 text-center">
            <span class="mb-3 inline-block text-xs font-semibold uppercase tracking-widest text-indigo-400">
                Partnerships
            </span>
            <h2 class="text-3xl font-semibold tracking-tight text-white md:text-4xl">
                Trusted by our clients
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-sm leading-relaxed text-app-muted">
                We work with startups, growing businesses, and established organizations
                to deliver reliable digital solutions.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-x-10 gap-y-14 sm:grid-cols-3 md:grid-cols-4">
            @foreach ($clients as $client)
                <div class="group aspect-[3/2] rounded-2xl border border-white/10 bg-slate-900/40 p-3
                            transition-all duration-300 hover:-translate-y-1 hover:border-white/25">
                    <div class="flex h-full w-full items-center justify-center overflow-hidden rounded-xl bg-white/[0.03]">
                        <img
                            src="{{ asset('storage/'.$client->logo) }}"
                            alt="{{ $client->name }}"
                            class="h-[85%] w-[85%] object-contain opacity-80 transition-all duration-300
                                   group-hover:scale-105 group-hover:opacity-100"
                        >
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
