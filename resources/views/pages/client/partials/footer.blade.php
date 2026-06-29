<footer
    class="relative bg-[rgba(2,6,23,0.65)]
           backdrop-blur-md border-t border-white/10"
>
    <div
        class="mx-auto max-w-7xl px-6
               min-h-[45vh]
               flex flex-col justify-between
               py-16"
    >

        <!-- ================= TOP ================= -->
        <div
            class="grid grid-cols-1 gap-y-14 gap-x-20
                   md:grid-cols-4 items-start"
        >

            <!-- ================= BRAND ================= -->
            <div>
                <div class="flex items-center gap-3">
                    @if (!empty($companyProfile->logo))
                        <img
                            src="{{ asset('storage/' . $companyProfile->logo) }}"
                            alt="{{ $companyProfile->company_name }}"
                            class="h-10 w-10 rounded-lg object-cover"
                        >
                    @else
                        <div
                            class="flex h-10 w-10 items-center justify-center
                                   rounded-lg bg-brand-main text-brand-text
                                   font-semibold"
                        >
                            {{ Str::substr($companyProfile->company_name ?? 'N', 0, 1) }}
                        </div>
                    @endif

                    <span class="text-lg font-semibold text-white">
                        {{ $companyProfile->company_name ?? 'Nexora Studio Digital' }}
                    </span>
                </div>

                <p class="mt-5 max-w-sm text-sm leading-relaxed text-app-muted">
                    {{ $companyProfile->about
                        ?? 'Digital solutions for growing brands. We build modern, scalable, and reliable digital products.' }}
                </p>
            </div>

            <!-- ================= COMPANY LINKS ================= -->
            <div>
                <h4 class="text-sm font-semibold text-white">Company</h4>

                @php
                    $linkBase = 'group flex items-center gap-3 text-app-muted transition hover:text-white';
                    $underline = 'absolute left-0 -bottom-1 h-[1px] w-0 bg-indigo-400 transition-all duration-300 group-hover:w-full';
                @endphp

                <ul class="mt-5 space-y-4 text-sm">
                    <li>
                        <a href="{{ route('about') }}" class="{{ $linkBase }}">
                            <span class="relative">
                                About Us
                                <span class="{{ $underline }}"></span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('articles') }}" class="{{ $linkBase }}">
                            <span class="relative">
                                Articles
                                <span class="{{ $underline }}"></span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products') }}" class="{{ $linkBase }}">
                            <span class="relative">
                                Products
                                <span class="{{ $underline }}"></span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events') }}" class="{{ $linkBase }}">
                            <span class="relative">
                                Events
                                <span class="{{ $underline }}"></span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- ================= CONTACT ================= -->
            <div class="md:justify-self-end">
                <h4 class="text-sm font-semibold text-white">Contact</h4>

                <ul class="mt-5 space-y-4 text-sm">
                    @if (filled($companyProfile->address))
                        <li>
                            <a
                                href="https://www.google.com/maps/search/?api=1&query={{ urlencode($companyProfile->address) }}"
                                target="_blank"
                                class="{{ $linkBase }}"
                            >
                                <span class="relative">
                                    {{ $companyProfile->address }}
                                    <span class="{{ $underline }}"></span>
                                </span>
                            </a>
                        </li>
                    @endif

                    @if (filled($companyProfile->phone))
                        <li>
                            <a
                                href="tel:{{ preg_replace('/\s+/', '', $companyProfile->phone) }}"
                                class="{{ $linkBase }}"
                            >
                                <span class="relative">
                                    {{ $companyProfile->phone }}
                                    <span class="{{ $underline }}"></span>
                                </span>
                            </a>
                        </li>
                    @endif

                    @if (filled($companyProfile->email))
                        <li>
                            <a
                                href="mailto:{{ $companyProfile->email }}"
                                class="{{ $linkBase }}"
                            >
                                <span class="relative">
                                    {{ $companyProfile->email }}
                                    <span class="{{ $underline }}"></span>
                                </span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- ================= SOCIAL ================= -->
            <div>
                <h4 class="text-sm font-semibold text-white">Social Media</h4>

                <ul class="mt-5 space-y-4 text-sm">
                    <li>
                        <a
                            href="{{ filled($companyProfile->whatsapp)
                                ? 'https://wa.me/' . preg_replace('/\D/', '', $companyProfile->whatsapp)
                                : '#' }}"
                            target="_blank"
                            class="{{ $linkBase }}"
                        >
                            <span class="relative">
                                WhatsApp
                                <span class="{{ $underline }}"></span>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ filled($companyProfile->instagram)
                                ? (str_starts_with($companyProfile->instagram, 'http')
                                    ? $companyProfile->instagram
                                    : 'https://instagram.com/' . ltrim($companyProfile->instagram, '@'))
                                : '#' }}"
                            target="_blank"
                            class="{{ $linkBase }}"
                        >
                            <span class="relative">
                                Instagram
                                <span class="{{ $underline }}"></span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- ================= BOTTOM ================= -->
        <div
            class="pt-8 mt-14 border-t border-white/10
                   text-center text-xs text-app-muted"
        >
            © {{ date('Y') }}
            <span class="font-medium text-white">
                {{ $companyProfile->company_name ?? 'Nexora Studio Digital' }}
            </span>.
            All rights reserved.
        </div>

    </div>
</footer>
