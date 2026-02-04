<section class="relative overflow-hidden bg-app-bg py-24">
    <div class="mx-auto max-w-6xl px-6">

        {{-- Card Wrapper --}}
        <div class="relative rounded-3xl border border-white/10
                    bg-gradient-to-br from-slate-900/70 to-slate-950/80
                    p-10 md:p-14 text-center">

            {{-- Soft Glow --}}
            <div class="pointer-events-none absolute inset-0 -z-10
                        bg-[radial-gradient(ellipse_at_top,rgba(99,102,241,0.15),transparent_60%)]">
            </div>

            {{-- Accent --}}
            <div class="mx-auto mb-6 h-1 w-20 rounded-full bg-indigo-500/70"></div>

            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-app-text">
                Let’s Build Something Meaningful Together
            </h2>

            <p class="mx-auto mt-5 max-w-2xl text-base leading-relaxed text-app-muted">
                Whether you’re planning a new digital product, refining an existing
                platform, or looking for a long-term technology partner —
                let’s start the conversation.
            </p>

            {{-- Button --}}
            <div class="mt-12">
                <a
                    href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center rounded-xl
                           bg-indigo-500 px-10 py-4
                           text-white font-medium
                           shadow-lg shadow-indigo-500/20
                           hover:bg-indigo-400 transition"
                >
                    Start Conversation
                </a>
            </div>

        </div>
    </div>
</section>
