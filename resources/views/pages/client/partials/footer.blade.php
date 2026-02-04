<footer
    class="relative
           bg-[rgba(2,6,23,0.65)]
           backdrop-blur-md
           border-t border-white/10"
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

            <!-- ==================================================
            | BRAND
            ================================================== -->
            <div>
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center
                               rounded-lg bg-btn-primary text-btn-text
                               font-semibold"
                    >
                        N
                    </div>

                    <span class="text-lg font-semibold text-white">
                        {{ $companyProfile->company_name ?? 'Nexora Studio Digital' }}
                    </span>
                </div>

                <p class="mt-5 max-w-sm text-sm leading-relaxed text-app-muted">
                    {{ $companyProfile->about
                        ?? 'Digital solutions for growing brands. We build modern, scalable, and reliable digital products.' }}
                </p>
            </div>

            <!-- ==================================================
            | COMPANY LINKS
            ================================================== -->
            <div>
                <h4 class="text-sm font-semibold text-white">
                    Company
                </h4>

                @php
                    $linkBase = 'group flex items-center gap-3 text-app-muted transition hover:text-white';
                    $underline = 'absolute left-0 -bottom-1 h-[1px] w-0 bg-indigo-400 transition-all duration-300 group-hover:w-full';
                @endphp

                <ul class="mt-5 space-y-4 text-sm">

                    <li>
                        <a href="{{ route('about') }}" class="{{ $linkBase }}">
                            <svg class="h-4 w-4 text-indigo-400"
                                 fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M13 16h-1v-4h-1m1-4h.01M12 18a6 6 0 100-12 6 6 0 000 12z"/>
                            </svg>
                            <span class="relative">
                                About Us
                                <span class="{{ $underline }}"></span>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('articles') }}" class="{{ $linkBase }}">
                            <svg class="h-4 w-4 text-indigo-400"
                                 fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 11H5m14-4H5m14 8H5"/>
                            </svg>
                            <span class="relative">
                                Articles
                                <span class="{{ $underline }}"></span>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('products') }}" class="{{ $linkBase }}">
                            <svg class="h-4 w-4 text-indigo-400"
                                 fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M20 7H4m16 0l-2 13H6L4 7m6-3h4"/>
                            </svg>
                            <span class="relative">
                                Products
                                <span class="{{ $underline }}"></span>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('events') }}" class="{{ $linkBase }}">
                            <svg class="h-4 w-4 text-indigo-400"
                                 fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8 7V3m8 4V3m-9 8h10m-13 9h16
                                         a2 2 0 002-2V7
                                         a2 2 0 00-2-2H4
                                         a2 2 0 00-2 2v11
                                         a2 2 0 002 2z"/>
                            </svg>
                            <span class="relative">
                                Events
                                <span class="{{ $underline }}"></span>
                            </span>
                        </a>
                    </li>

                </ul>
            </div>

            <!-- ==================================================
            | CONTACT (CLICKABLE)
            ================================================== -->
            <div class="md:justify-self-end">
                <h4 class="text-sm font-semibold text-white">
                    Contact
                </h4>

                <ul class="mt-5 space-y-4 text-sm">

                    {{-- ADDRESS → GOOGLE MAPS --}}
                    @if (filled($companyProfile->address))
                        <li>
                            <a
                                href="https://www.google.com/maps/search/?api=1&query={{ urlencode($companyProfile->address) }}"
                                target="_blank"
                                rel="noopener"
                                class="group flex items-start gap-3 text-app-muted hover:text-white transition"
                            >
                                <svg class="h-4 w-4 mt-0.5 text-indigo-400"
                                     fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 21s-6-5.686-6-10
                                             a6 6 0 1112 0
                                             c0 4.314-6 10-6 10z"/>
                                    <circle cx="12" cy="11" r="2.5"/>
                                </svg>
                                <span class="relative">
                                    {{ $companyProfile->address }}
                                    <span class="{{ $underline }}"></span>
                                </span>
                            </a>
                        </li>
                    @endif

                    {{-- PHONE → CALL --}}
                    @if (filled($companyProfile->phone))
                        <li>
                            <a
                                href="tel:{{ preg_replace('/\s+/', '', $companyProfile->phone) }}"
                                class="group flex items-center gap-3 text-app-muted hover:text-white transition"
                            >
                                <svg class="h-4 w-4 text-indigo-400"
                                     fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2 3.5A1.5 1.5 0 013.5 2h2
                                             A1.5 1.5 0 017 3.5v2
                                             A1.5 1.5 0 015.5 7H4.121
                                             a14.978 14.978 0 006.757 6.757V12.5
                                             A1.5 1.5 0 0112.5 11h2
                                             a1.5 1.5 0 011.5 1.5v2
                                             A1.5 1.5 0 0114.5 16h-.5
                                             C7.373 16 2 10.627 2 4v-.5z"/>
                                </svg>
                                <span class="relative">
                                    {{ $companyProfile->phone }}
                                    <span class="{{ $underline }}"></span>
                                </span>
                            </a>
                        </li>
                    @endif

                    {{-- FAX → FAX --}}
                    @if (filled($companyProfile->fax))
                        <li>
                            <a
                                href="fax:{{ preg_replace('/\s+/', '', $companyProfile->fax) }}"
                                class="group flex items-center gap-3 text-app-muted hover:text-white transition"
                            >
                                <svg class="h-4 w-4 text-indigo-400"
                                     fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6 9V2h12v7"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6 18h12v4H6z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6 14h12"/>
                                </svg>
                                <span class="relative">
                                    {{ $companyProfile->fax }}
                                    <span class="{{ $underline }}"></span>
                                </span>
                            </a>
                        </li>
                    @endif

                    {{-- EMAIL → MAIL CLIENT --}}
                    @if (filled($companyProfile->email))
                        <li>
                            <a
                                href="mailto:{{ $companyProfile->email }}"
                                class="group flex items-center gap-3 text-app-muted hover:text-white transition"
                            >
                                <svg class="h-4 w-4 text-indigo-400"
                                     fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 8l9 6 9-6"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M21 8v8a2 2 0 01-2 2H5
                                             a2 2 0 01-2-2V8"/>
                                </svg>
                                <span class="relative">
                                    {{ $companyProfile->email }}
                                    <span class="{{ $underline }}"></span>
                                </span>
                            </a>
                        </li>
                    @endif

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
