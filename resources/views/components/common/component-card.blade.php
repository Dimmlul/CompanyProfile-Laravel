{{-- Generic bordered card with an optional title/description header and a slot for the body content. --}}
@props([
    'title' => null,
    'desc' => null,
])

<div
    {{ $attributes->merge([
        'class' => '
            rounded-2xl
            border border-gray-200
            bg-white
            dark:border-gray-800
            dark:bg-white/[0.03]
        '
    ]) }}
>

    {{-- HEADER --}}
    @if ($title)
        <div class="px-6 py-5">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                {{ $title }}
            </h3>

            @if ($desc)
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ $desc }}
                </p>
            @endif
        </div>
    @endif

    {{-- BODY --}}
    <div
        class="
            p-4
            sm:p-6
            {{ $title ? 'border-t border-gray-100 dark:border-gray-800' : '' }}
        "
    >
        <div class="space-y-4">
            {{ $slot }}
        </div>
    </div>

</div>
