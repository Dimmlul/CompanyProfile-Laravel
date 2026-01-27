<section class="py-16 bg-app-bg">
    <div class="mx-auto max-w-5xl px-6 text-center">

        <h2 class="text-2xl font-bold text-app-text">
            Vision & Mission
        </h2>

        @if ($companyProfile)

            @if ($companyProfile->vision)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-app-text">Vision</h3>
                    <p class="mt-2 text-app-muted">
                        {{ $companyProfile->vision }}
                    </p>
                </div>
            @endif

            @if ($companyProfile->mission)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-app-text">Mission</h3>
                    <p class="mt-2 text-app-muted whitespace-pre-line">
                        {{ $companyProfile->mission }}
                    </p>
                </div>
            @endif

        @else
            <p class="mt-4 text-app-muted">
                Company profile has not been set yet.
            </p>
        @endif

    </div>
</section>
