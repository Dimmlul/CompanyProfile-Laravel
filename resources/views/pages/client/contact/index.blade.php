@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-7xl px-6">

        {{-- HEADING --}}
        <div class="mb-16 max-w-2xl">
            <h1 class="text-4xl font-semibold text-white">
                Get in Touch
            </h1>
            <p class="mt-4 text-app-muted leading-relaxed">
                Have a project in mind or just want to say hello?
                Our team at
                <span class="font-medium text-white">
                    {{ $companyProfile->company_name }}
                </span>
                would love to hear from you.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-16 lg:grid-cols-2">

            {{-- COMPANY INFO --}}
            <div class="space-y-8">

                {{-- ABOUT --}}
                <div class="text-sm leading-relaxed text-app-muted">
                    {{ $companyProfile->about }}
                </div>

                {{-- DIVIDER --}}
                <div class="h-px w-full bg-white/10"></div>

                {{-- CONTACT DETAILS --}}
                <div class="grid grid-cols-1 gap-5 text-sm">

                    {{-- ADDRESS --}}
                    <div>
                        <p class="mb-1 text-xs uppercase tracking-wide text-app-muted">
                            Address
                        </p>
                        <p class="font-medium text-white leading-relaxed">
                            {{ $companyProfile->address }}
                        </p>
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <p class="mb-1 text-xs uppercase tracking-wide text-app-muted">
                            Email
                        </p>
                        <a
                            href="mailto:{{ $companyProfile->email }}"
                            class="font-medium text-white hover:underline"
                        >
                            {{ $companyProfile->email }}
                        </a>
                    </div>

                    {{-- PHONE --}}
                    <div>
                        <p class="mb-1 text-xs uppercase tracking-wide text-app-muted">
                            Phone
                        </p>
                        <a
                            href="tel:{{ $companyProfile->phone }}"
                            class="font-medium text-white hover:underline"
                        >
                            {{ $companyProfile->phone }}
                        </a>
                    </div>

                    {{-- FAX --}}
                    @if(!empty($companyProfile->fax))
                    <div>
                        <p class="mb-1 text-xs uppercase tracking-wide text-app-muted">
                            Fax
                        </p>
                        <p class="font-medium text-white">
                            {{ $companyProfile->fax }}
                        </p>
                    </div>
                    @endif

                </div>
            </div>

            {{-- CONTACT FORM --}}
            <div class="rounded-2xl border border-white/10 bg-white/5 p-8 backdrop-blur">
                <h3 class="mb-6 text-lg font-semibold text-white">
                    Send Us a Message
                </h3>

                <form id="contact-form" class="space-y-5">

                    {{-- TARGET EMAIL --}}
                    <input
                        type="hidden"
                        name="to_email"
                        value="{{ $companyProfile->email }}"
                    >

                    {{-- NAME --}}
                    <input
                        type="text"
                        name="from_name"
                        placeholder="Your Name"
                        required
                        class="w-full rounded-lg border border-white/10 bg-transparent
                               px-4 py-3 text-sm text-white
                               placeholder:text-app-muted focus:outline-none"
                    >

                    {{-- EMAIL --}}
                    <input
                        type="email"
                        name="from_email"
                        placeholder="Email Address"
                        required
                        class="w-full rounded-lg border border-white/10 bg-transparent
                               px-4 py-3 text-sm text-white
                               placeholder:text-app-muted focus:outline-none"
                    >

                    {{-- SUBJECT --}}
                    <input
                        type="text"
                        name="subject"
                        placeholder="Subject"
                        required
                        class="w-full rounded-lg border border-white/10 bg-transparent
                               px-4 py-3 text-sm text-white
                               placeholder:text-app-muted focus:outline-none"
                    >

                    {{-- MESSAGE --}}
                    <textarea
                        name="message"
                        rows="4"
                        placeholder="Your Message"
                        required
                        class="w-full rounded-lg border border-white/10 bg-transparent
                               px-4 py-3 text-sm text-white
                               placeholder:text-app-muted focus:outline-none"
                    ></textarea>

                    {{-- SUBMIT --}}
                    <button
                        type="submit"
                        class="w-full rounded-lg bg-white py-3
                               text-sm font-semibold text-gray-900
                               transition hover:bg-gray-200"
                    >
                        Send Message
                    </button>

                    <p id="form-status" class="text-sm text-app-muted"></p>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection

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
