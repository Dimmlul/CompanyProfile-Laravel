<section
    x-data="heroReveal()"
    x-init="init()"
    class="relative min-h-screen w-full overflow-hidden bg-app-bg"
>

    <!-- ==========================================================
    | BACKGROUND
    ========================================================== -->
    <div class="absolute inset-0 -z-10">
        <img
            src="{{ asset('images/hero.jpg') }}"
            alt="{{ $companyProfile->company_name ?? 'Company Hero Image' }}"
            class="h-full w-full object-cover opacity-40 scale-105"
        >

        <div class="absolute inset-0 bg-gradient-to-b
                    from-app-bg/90 via-app-bg/70 to-app-bg">
        </div>
    </div>

    <!-- ==========================================================
    | CONTENT
    ========================================================== -->
    <div
        class="relative mx-auto max-w-7xl px-6
               min-h-screen
               flex flex-col items-center justify-center
               text-center"
    >

        <!-- OFFSET FOR FLOATING NAVBAR -->
        <div class="pt-28"></div>

        <!-- BADGE -->
        <div
            x-ref="badge"
            class="mb-6 inline-flex items-center gap-2
                   rounded-full border border-white/10
                   bg-white/5 px-4 py-1.5
                   text-xs uppercase tracking-wider text-app-muted
                   opacity-0 translate-y-3"
        >
            <svg class="h-4 w-4 text-indigo-400"
                 fill="none" stroke="currentColor"
                 stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>

            {{ $companyProfile->tagline ?? 'Digital Solutions for Growing Brands' }}
        </div>

        <!-- TITLE -->
        <h1
            x-ref="title"
            class="mx-auto max-w-4xl
                   text-4xl md:text-5xl lg:text-6xl
                   font-semibold tracking-tight text-white
                   opacity-0 translate-y-4"
        >
            Build Powerful Digital Experiences
            <br class="hidden sm:block">
            with
            <span class="text-indigo-400">
                {{ $companyProfile->company_name ?? 'Our Company' }}
            </span>
        </h1>

        <!-- DESCRIPTION -->
        <p
            x-ref="desc"
            class="mx-auto mt-6 max-w-2xl
                   text-base leading-relaxed text-app-muted
                   opacity-0 translate-y-4"
        >
            {{ $companyProfile->about
                ?? 'We help businesses and organizations build modern, scalable, and reliable digital products for long-term growth.' }}
        </p>

        <!-- CTA -->
        <div
            x-ref="cta"
            class="mt-10 flex flex-col items-center gap-4 sm:flex-row
                   opacity-0 translate-y-4"
        >

            <!-- PRIMARY -->
            <a href="{{ route('contact') }}"
               class="inline-flex h-12 items-center justify-center
                      rounded-full bg-white px-7
                      text-sm font-semibold text-gray-900
                      transition-all duration-200
                      hover:bg-gray-200 hover:-translate-y-0.5">
                Get in Touch
            </a>

            <!-- SECONDARY -->
            <a href="{{ route('products') }}"
               class="inline-flex h-12 items-center justify-center gap-2
                      rounded-full border border-white/15
                      bg-white/5 px-7
                      text-sm font-medium text-app-text
                      backdrop-blur
                      transition-all duration-200
                      hover:bg-white/10 hover:border-white/25 hover:-translate-y-0.5">
                View Our Products
                <svg class="h-4 w-4"
                     fill="none" stroke="currentColor"
                     stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- BOTTOM SPACING -->
        <div class="pb-24"></div>

    </div>
</section>

@push('scripts')
<script>
function heroReveal() {
    return {
        init() {
            const items = [
                this.$refs.badge,
                this.$refs.title,
                this.$refs.desc,
                this.$refs.cta,
            ]

            items.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.remove('opacity-0', 'translate-y-3', 'translate-y-4')
                    el.classList.add(
                        'opacity-100',
                        'translate-y-0',
                        'transition-all',
                        'duration-700',
                        'ease-out'
                    )
                }, index * 120)
            })
        }
    }
}
</script>
@endpush
