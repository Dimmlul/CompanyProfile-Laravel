@php
    $waLink = filled($companyProfile->whatsapp)
        ? 'https://wa.me/' . preg_replace('/\D/', '', $companyProfile->whatsapp)
        : null;
@endphp

<section class="bg-app-bg py-24 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">
        <div x-data x-reveal
             class="surface relative isolate overflow-hidden rounded-3xl px-6 py-16 text-center md:px-12 md:py-24">

            {{-- texture + glow, masked --}}
            <div class="absolute inset-0 -z-10 bg-grid [mask-image:radial-gradient(ellipse_at_center,black,transparent_75%)]"></div>
            <div class="absolute left-1/2 top-0 -z-10 h-64 w-[36rem] -translate-x-1/2 rounded-full bg-brand-main/20 blur-3xl"></div>

            <span class="eyebrow">Let's talk</span>
            <h2 class="section-title mx-auto max-w-2xl">Have a project in mind?</h2>
            <p class="section-subtitle mx-auto max-w-xl text-base">
                Tell us what you're building. We'll get back to you within one business day.
            </p>

            <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('contact') }}" class="btn-primary btn-lg">Start a conversation</a>
                @if ($waLink)
                    <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn-outline btn-lg">Chat on WhatsApp</a>
                @endif
            </div>

            @if (filled($companyProfile->email) || filled($companyProfile->phone))
                <div class="mt-8 flex flex-wrap items-center justify-center gap-x-8 gap-y-2 text-sm text-app-muted">
                    @if (filled($companyProfile->email))
                        <a href="mailto:{{ $companyProfile->email }}" class="transition hover:text-app-heading">{{ $companyProfile->email }}</a>
                    @endif
                    @if (filled($companyProfile->phone))
                        <a href="tel:{{ $companyProfile->phone }}" class="transition hover:text-app-heading">{{ $companyProfile->phone }}</a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>
