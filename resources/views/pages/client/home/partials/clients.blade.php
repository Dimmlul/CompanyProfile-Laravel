{{-- Landing section: client logo wall. --}}
<section class="bg-app-bg py-24 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">

        <x-section-heading x-data x-reveal align="center" class="mb-12"
            eyebrow="Partnerships"
            title="Companies we've worked with"
            subtitle="From early-stage startups to established organizations, teams trust us to deliver." />

        <div x-data x-reveal
             class="surface grid grid-cols-2 divide-x divide-y divide-app-border overflow-hidden rounded-2xl
                    sm:grid-cols-3 lg:grid-cols-4">
            @foreach ($clients as $client)
                <div class="flex items-center justify-center p-8 sm:p-10">
                    @if ($client->logo)
                        <img src="{{ asset('storage/'.$client->logo) }}" alt="{{ $client->name }}"
                             class="h-9 w-auto max-w-[140px] object-contain opacity-50 grayscale transition duration-300
                                    hover:opacity-100 hover:grayscale-0">
                    @else
                        {{-- No logo uploaded yet — show the client's initial instead of a broken image --}}
                        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-app-surface-2 text-sm font-semibold text-app-muted">
                            {{ strtoupper(mb_substr($client->name, 0, 1)) }}
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
