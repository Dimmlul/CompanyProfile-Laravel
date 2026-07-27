{{-- Landing section: vision/mission statement and a list of company strengths. --}}
<section class="bg-app-bg py-24 lg:py-28">
    <div class="mx-auto max-w-5xl px-6">

        <span x-data x-reveal class="eyebrow">What drives us</span>

        {{-- The vision stated as a large pull quote, standing as this section's centerpiece
             instead of the eyebrow/title/subtitle pattern used by the sections around it. --}}
        <p x-data x-reveal="{ delay: 80 }"
           class="mt-5 max-w-3xl text-3xl font-medium leading-[1.2] tracking-tight text-app-heading sm:text-4xl lg:text-[2.75rem]">
            {{ filled($companyProfile->vision) ? $companyProfile->vision : 'To become a trusted digital partner for growing brands worldwide.' }}
        </p>

        <div x-data x-reveal="{ delay: 160 }"
             class="mt-14 grid gap-10 border-t border-app-border pt-10 lg:grid-cols-[1.3fr_1fr] lg:gap-16">

            {{-- Mission, folded in as supporting text rather than a boxed twin of the vision --}}
            <div>
                <span class="text-xs font-semibold uppercase tracking-widest text-app-muted">Mission</span>
                <p class="mt-3 max-w-xl text-lg leading-relaxed text-app-muted">
                    {{ filled($companyProfile->mission) ? $companyProfile->mission : 'To design and build digital products that solve real problems and deliver lasting value.' }}
                </p>
            </div>

            {{-- Strengths as a divided ledger list — no icon-in-circle cards --}}
            <ul>
                @foreach (['Thoughtful execution', 'Scalable by design', 'Long-term partnership', 'Clear communication'] as $strength)
                    <li @class(['flex items-baseline gap-4 py-3', 'border-t border-app-border' => !$loop->first])>
                        <span class="font-mono text-xs text-app-muted">0{{ $loop->iteration }}</span>
                        <span class="text-sm font-medium text-app-heading">{{ $strength }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
