{{-- Landing section: closing call-to-action banner. --}}
@php
    $waLink = filled($companyProfile->whatsapp)
        ? 'https://wa.me/' . preg_replace('/\D/', '', $companyProfile->whatsapp)
        : null;
@endphp

<x-cta eyebrow="Let's talk"
       title="Have a project in mind?"
       subtitle="Tell us what you're building. We'll get back to you within one business day.">
    <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
        <a href="{{ route('contact') }}" class="btn-primary btn-lg">Start a conversation</a>
        @if ($waLink)
            <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn-outline btn-lg">Chat on WhatsApp</a>
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
</x-cta>
