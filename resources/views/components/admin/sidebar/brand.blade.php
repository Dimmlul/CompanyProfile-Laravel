{{-- Sidebar header: company logo and name. --}}
@props(['companyProfile'])

<div
    class="flex h-16 items-center gap-3 px-6
           border-b border-[var(--color-border-soft)]"
>
    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-app overflow-hidden shrink-0">
        @if ($companyProfile?->logo)
            <img src="{{ asset('storage/'.$companyProfile->logo) }}"
                 class="h-full w-full object-contain">
        @else
            <span class="text-sm font-bold text-indigo-600">
                {{ Str::upper(Str::substr($companyProfile->company_name ?? 'CP', 0, 2)) }}
            </span>
        @endif
    </div>

    <span
        x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
        class="text-lg font-semibold truncate"
    >
        {{ $companyProfile->company_name ?? 'Admin Panel' }}
    </span>
</div>
