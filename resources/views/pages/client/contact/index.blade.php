@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-7xl px-6">

        <!-- Heading -->
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

        <div class="grid grid-cols-1 gap-16 lg:grid-cols-2">

            <!-- Company Info -->
            <div class="space-y-8">
                <p class="text-sm leading-relaxed text-app-muted">
                    {{ $companyProfile->about }}
                </p>

                <ul class="space-y-4 text-sm text-app-muted">

                    {{-- Address --}}
                    @if ($companyProfile->address)
                        <li class="flex items-start gap-3">
                            <!-- Map / Location -->
                            <svg class="mt-0.5 h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z"/>
                            </svg>
                            <span>{{ $companyProfile->address }}</span>
                        </li>
                    @endif

                    {{-- Phone --}}
                    @if ($companyProfile->phone)
                        <li class="flex items-center gap-3">
                            <!-- Phone -->
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a1.5 1.5 0 001.5-1.5v-3.018
                                         a1.5 1.5 0 00-1.318-1.488l-3.27-.408a1.5 1.5 0 00-1.54.873l-.984 2.46
                                         a12.06 12.06 0 01-5.373-5.373l2.46-.984a1.5 1.5 0 00.873-1.54l-.408-3.27
                                         A1.5 1.5 0 006.768 3.75H3.75a1.5 1.5 0 00-1.5 1.5v1.5z"/>
                            </svg>
                            <span>{{ $companyProfile->phone }}</span>
                        </li>
                    @endif

                    {{-- Email --}}
                    @if ($companyProfile->email)
                        <li class="flex items-center gap-3">
                            <!-- Mail -->
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15
                                         a2.25 2.25 0 01-2.25-2.25V6.75
                                         M21.75 6.75A2.25 2.25 0 0019.5 4.5h-15
                                         a2.25 2.25 0 00-2.25 2.25
                                         m19.5 0l-9.75 6.75L2.25 6.75"/>
                            </svg>
                            <span>{{ $companyProfile->email }}</span>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Contact Form -->
            <div class="rounded-2xl border border-white/10 bg-white/5 p-8 backdrop-blur">
                <h3 class="mb-6 text-lg font-semibold text-white">
                    Send Us a Message
                </h3>

                <form id="contact-form" class="space-y-5">

                    {{-- IMPORTANT: must match EmailJS template --}}
                    <input type="hidden" name="to_email" value="{{ $companyProfile->email }}">

                    <input
                        type="text"
                        name="from_name"
                        placeholder="Your Name"
                        required
                        class="w-full rounded-lg border border-white/10 bg-transparent px-4 py-3
                               text-sm text-white placeholder:text-app-muted focus:border-white focus:outline-none"
                    >

                    <input
                        type="email"
                        name="from_email"
                        placeholder="Email Address"
                        required
                        class="w-full rounded-lg border border-white/10 bg-transparent px-4 py-3
                               text-sm text-white placeholder:text-app-muted focus:border-white focus:outline-none"
                    >

                    <textarea
                        name="message"
                        rows="4"
                        placeholder="Your Message"
                        required
                        class="w-full rounded-lg border border-white/10 bg-transparent px-4 py-3
                               text-sm text-white placeholder:text-app-muted focus:border-white focus:outline-none"
                    ></textarea>

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

        const status = document.getElementById('form-status');
        status.textContent = 'Sending message...';

        emailjs.sendForm(
            '{{ config('services.emailjs.service_id') }}',
            '{{ config('services.emailjs.template_id') }}',
            this
        ).then(() => {
            status.textContent = 'Message sent successfully.';
            this.reset();
        }).catch(error => {
            console.error('EmailJS error:', error);
            status.textContent = 'Failed to send message.';
        });
    });
</script>
@endpush
