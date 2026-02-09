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
            <p class="mt-4 text-app-muted">
                Have a project in mind or just want to say hello?
                Our team at
                <span class="font-medium text-white">
                    {{ $companyProfile->company_name }}
                </span>
                would love to hear from you.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

            {{-- COMPANY INFO --}}
            <div class="space-y-6 text-sm text-app-muted">
                {{ $companyProfile->about }}
            </div>

            {{-- CONTACT FORM --}}
            <div class="rounded-2xl border border-white/10 bg-white/5 p-8 backdrop-blur">
                <h3 class="mb-6 text-lg font-semibold text-white">
                    Send Us a Message
                </h3>

                <form
                    id="contact-form"
                    method="POST"
                    action="{{ route('contact.message.send') }}"
                    class="space-y-5"
                >
                    @csrf

                    {{-- EmailJS target --}}
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

                    {{-- SUBJECT → ONLY AUTH USER --}}
                    @auth
                        <input
                            type="text"
                            name="subject"
                            placeholder="Subject"
                            required
                            class="w-full rounded-lg border border-white/10 bg-transparent
                                   px-4 py-3 text-sm text-white
                                   placeholder:text-app-muted focus:outline-none"
                        >
                    @endauth

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
                               hover:bg-gray-200 transition"
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
    emailjs.init('{{ config('services.emailjs.public_key') }}');

    document.getElementById('contact-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const form   = this;
        const status = document.getElementById('form-status');

        status.textContent = 'Sending message...';

        fetch(form.action, {
            method: 'POST',
            credentials: 'same-origin', // 🔥 INI KUNCI
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: new FormData(form),
        })

        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                throw text;
            }
            return res.json();
        })
        .then(res => {

            // AUTH USER → SAVED TO DB
            if (res.status === 'saved') {
                status.textContent = res.message;
                form.reset();
                return;
            }

            // GUEST → SEND EMAILJS
            if (res.status === 'guest') {
                emailjs.sendForm(
                    '{{ config('services.emailjs.service_id') }}',
                    '{{ config('services.emailjs.template_id') }}',
                    form
                )
                .then(() => {
                    status.textContent = 'Message sent successfully.';
                    form.reset();
                })
                .catch(() => {
                    status.textContent = 'Failed to send message.';
                });
            }
        })
        .catch(err => {
            console.error(err);
            status.textContent = 'Something went wrong.';
        });
    });
</script>
@endpush
