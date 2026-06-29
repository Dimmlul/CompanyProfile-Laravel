<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-6xl px-6">
        <div x-data x-reveal
             class="rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 to-slate-950 p-10 text-center md:p-14">

            <div class="mx-auto mb-6 h-1 w-20 rounded-full bg-indigo-500/70"></div>

            <h2 class="text-3xl font-semibold tracking-tight text-app-text md:text-4xl">
                Let's build something together
            </h2>

            <p class="mx-auto mt-5 max-w-2xl text-base leading-relaxed text-app-muted">
                Planning a new product, improving an existing platform, or looking for a
                long-term technology partner? Let's start the conversation.
            </p>

            <div class="mt-10">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center rounded-xl bg-indigo-500 px-10 py-4 font-medium text-white
                          shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-400">
                    Start a conversation
                </a>
            </div>

            @if (filled($companyProfile->email) || filled($companyProfile->phone))
                <div class="mt-8 flex flex-wrap items-center justify-center gap-x-8 gap-y-2 text-sm text-app-muted">
                    @if (filled($companyProfile->email))
                        <a href="mailto:{{ $companyProfile->email }}" class="transition hover:text-white">
                            {{ $companyProfile->email }}
                        </a>
                    @endif
                    @if (filled($companyProfile->phone))
                        <a href="tel:{{ $companyProfile->phone }}" class="transition hover:text-white">
                            {{ $companyProfile->phone }}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>
