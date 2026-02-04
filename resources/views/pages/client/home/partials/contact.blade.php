<section class="relative overflow-hidden bg-app-bg py-20">
    <div class="mx-auto max-w-5xl px-6 text-center">

        {{-- Accent --}}
        <div class="mx-auto mb-6 h-1 w-16 rounded-full bg-indigo-500/60"></div>

        <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-app-text">
            Let’s Build Something Meaningful
        </h2>

        <p class="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-app-muted">
            Whether you’re planning a new digital product, refining an existing
            platform, or exploring collaboration opportunities — we’d love to
            hear from you.
        </p>

        <a
            href="{{ route('contact') }}"
            class="group inline-flex items-center gap-2 mt-10 rounded-xl
                   bg-btn-primary px-8 py-4
                   text-btn-text font-medium
                   hover:bg-btn-primary-hover transition"
        >
            <span>Start a Conversation</span>
            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1"
                 fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 12h14"/>
            </svg>
        </a>

    </div>
</section>
