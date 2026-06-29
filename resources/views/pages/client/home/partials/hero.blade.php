<section class="relative flex min-h-screen items-center justify-center overflow-hidden bg-app-bg">

    {{-- Background image + fade into the page --}}
    <div class="absolute inset-0 -z-10">
        <img
            src="{{ asset('images/hero.jpg') }}"
            alt="{{ $companyProfile->company_name ?? 'Company' }}"
            class="h-full w-full scale-105 object-cover opacity-40"
        >
        <div class="absolute inset-0 bg-gradient-to-b from-app-bg/90 via-app-bg/70 to-app-bg"></div>
    </div>

    <div class="mx-auto max-w-3xl px-6 py-32 text-center">

        <span
            x-data x-reveal
            class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/10
                   bg-white/5 px-4 py-1.5 text-xs uppercase tracking-wider text-app-muted"
        >
            {{ $companyProfile->tagline ?? 'Digital Solutions for Growing Brands' }}
        </span>

        <h1
            x-data x-reveal="{ delay: 100 }"
            class="text-4xl font-semibold tracking-tight text-white md:text-5xl lg:text-6xl"
        >
            Build powerful digital experiences with
            <span class="text-indigo-400">{{ $companyProfile->company_name ?? 'our team' }}</span>
        </h1>

        <p
            x-data x-reveal="{ delay: 200 }"
            class="mx-auto mt-6 max-w-2xl text-base leading-relaxed text-app-muted"
        >
            {{ $companyProfile->about
                ?? 'We help businesses build modern, scalable, and reliable digital products for long-term growth.' }}
        </p>

        <div
            x-data x-reveal="{ delay: 300 }"
            class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row"
        >
            <a href="{{ route('contact') }}"
               class="inline-flex h-12 items-center rounded-full bg-white px-7 text-sm font-semibold
                      text-gray-900 transition hover:-translate-y-0.5 hover:bg-gray-200">
                Get in touch
            </a>

            <a href="{{ route('products') }}"
               class="inline-flex h-12 items-center rounded-full border border-white/15 bg-white/5 px-7
                      text-sm font-medium text-app-text backdrop-blur
                      transition hover:-translate-y-0.5 hover:border-white/25 hover:bg-white/10">
                View our products
            </a>
        </div>
    </div>
</section>
