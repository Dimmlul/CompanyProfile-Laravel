@php
    $hasLocation = filled($companyProfile->address)
        || (filled($companyProfile->latitude) && filled($companyProfile->longitude));
@endphp

{{-- Company location map (Leaflet), driven by the company profile address/coordinates --}}
@if ($hasLocation)
    <section class="bg-app-bg pb-24 lg:pb-28">
        <div class="mx-auto max-w-7xl px-6">
            <div x-data x-reveal class="grid gap-8 lg:grid-cols-[0.85fr_1.15fr] lg:items-center lg:gap-14">

                {{-- Address & quick contact --}}
                <div>
                    <span class="eyebrow">Visit us</span>
                    <h2 class="section-title">Where to find us</h2>

                    @if (filled($companyProfile->address))
                        <p class="section-subtitle">{{ $companyProfile->address }}</p>
                    @endif

                    <div class="mt-6 space-y-2 text-sm">
                        @if (filled($companyProfile->email))
                            <a href="mailto:{{ $companyProfile->email }}" class="block text-app-muted transition hover:text-app-heading">
                                {{ $companyProfile->email }}
                            </a>
                        @endif
                        @if (filled($companyProfile->phone))
                            <a href="callto:{{ $companyProfile->phone }}" class="block text-app-muted transition hover:text-app-heading">
                                {{ $companyProfile->phone }}
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Map --}}
                <x-map
                    :lat="$companyProfile->latitude"
                    :lng="$companyProfile->longitude"
                    :address="$companyProfile->address"
                    :label="$companyProfile->company_name"
                    height="400px" />
            </div>
        </div>
    </section>
@endif
