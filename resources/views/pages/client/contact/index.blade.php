{{-- Contact page: company info, location map, and a contact form that emails the company. --}}
@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-7xl px-6">

        {{-- HEADING --}}
        <div class="mb-16 max-w-2xl">
            <h1 class="text-4xl font-semibold text-app-heading">Get in Touch</h1>
            <p class="mt-4 leading-relaxed text-app-muted">
                Have a project in mind or just want to say hello? Our team at
                <span class="font-medium text-app-heading">{{ $companyProfile->company_name }}</span>
                would love to hear from you.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-16 lg:grid-cols-2">

            {{-- COMPANY INFO --}}
            <div class="space-y-8">
                <div class="text-sm leading-relaxed text-app-muted">
                    {{ $companyProfile->about }}
                </div>

                <div class="h-px w-full bg-app-border"></div>

                <div class="grid grid-cols-1 gap-5 text-sm">
                    <div>
                        <p class="mb-1 text-xs uppercase tracking-wide text-app-muted">Address</p>
                        <p class="font-medium leading-relaxed text-app-heading">{{ $companyProfile->address }}</p>
                    </div>
                    <div>
                        <p class="mb-1 text-xs uppercase tracking-wide text-app-muted">Email</p>
                        <a href="mailto:{{ $companyProfile->email }}" class="font-medium text-app-heading hover:underline">
                            {{ $companyProfile->email }}
                        </a>
                    </div>
                    <div>
                        <p class="mb-1 text-xs uppercase tracking-wide text-app-muted">Phone</p>
                        <a href="tel:{{ $companyProfile->phone }}" class="font-medium text-app-heading hover:underline">
                            {{ $companyProfile->phone }}
                        </a>
                    </div>
                    @if(!empty($companyProfile->fax))
                        <div>
                            <p class="mb-1 text-xs uppercase tracking-wide text-app-muted">Fax</p>
                            <p class="font-medium text-app-heading">{{ $companyProfile->fax }}</p>
                        </div>
                    @endif
                </div>

                {{-- Location map (Leaflet) --}}
                @if (filled($companyProfile->address) || (filled($companyProfile->latitude) && filled($companyProfile->longitude)))
                    <div>
                        <p class="mb-2 text-xs uppercase tracking-wide text-app-muted">Find us</p>
                        <x-map
                            :lat="$companyProfile->latitude"
                            :lng="$companyProfile->longitude"
                            :address="$companyProfile->address"
                            :label="$companyProfile->company_name" />
                    </div>
                @endif
            </div>

            {{-- CONTACT FORM --}}
            <div class="surface rounded-2xl p-8">
                <h3 class="mb-6 text-lg font-semibold text-app-heading">Send Us a Message</h3>

                <form id="contact-form" class="space-y-5">
                    <input type="hidden" name="to_email" value="{{ $companyProfile->email }}">

                    @php
                        $field = 'w-full rounded-lg border border-app-border bg-transparent px-4 py-3 text-sm
                                  text-app-heading placeholder:text-app-muted focus:border-brand-main focus:outline-none';
                    @endphp

                    <input type="text" name="from_name" placeholder="Your Name" required class="{{ $field }}">
                    <input type="email" name="from_email" placeholder="Email Address" required class="{{ $field }}">
                    <input type="text" name="subject" placeholder="Subject" required class="{{ $field }}">
                    <textarea name="message" rows="4" placeholder="Your Message" required class="{{ $field }}"></textarea>

                    <button type="submit" class="btn-primary w-full">Send Message</button>

                    <p id="form-status" class="text-sm text-app-muted"></p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

{{-- Sends the contact form straight to EmailJS from the browser, bypassing the Laravel backend. --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    emailjs.init('{{ config('services.emailjs.public_key') }}');

    const form   = document.getElementById('contact-form');
    const status = document.getElementById('form-status');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        status.textContent = 'Sending message...';

        emailjs.sendForm(
            '{{ config('services.emailjs.service_id') }}',
            '{{ config('services.emailjs.template_id') }}',
            form
        )
        .then(() => {
            status.textContent = 'Message sent successfully.';
            form.reset();
        })
        .catch(error => {
            console.error('EMAILJS ERROR:', error);
            status.textContent = error.text || 'Failed to send message.';
        });
    });
});
</script>
@endpush
