{{-- Account menu: initial avatar that opens a dropdown with logout. --}}
<div x-data="{ open: false }" class="relative border-l border-app-border pl-3">

    {{-- Trigger: circular initial avatar --}}
    <button
        @click="open = !open"
        @click.outside="open = false"
        class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-soft text-sm font-semibold text-brand-accent"
        aria-label="Account menu"
    >
        {{ strtoupper(mb_substr(auth()->user()->name ?? 'A', 0, 1)) }}
    </button>

    {{-- Dropdown --}}
    <div
        x-show="open"
        x-cloak
        x-transition
        class="surface absolute right-0 top-12 w-52 overflow-hidden rounded-xl shadow-lg"
    >
        <div class="border-b border-app-border px-4 py-3">
            <p class="truncate text-sm font-medium text-app-heading">{{ auth()->user()->name ?? 'Admin' }}</p>
            <p class="truncate text-xs text-app-muted">{{ auth()->user()->email }}</p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full px-4 py-2.5 text-left text-sm text-danger hover:bg-app-surface-2">
                Logout
            </button>
        </form>
    </div>
</div>
