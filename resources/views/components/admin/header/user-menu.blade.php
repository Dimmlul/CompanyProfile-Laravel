<!-- resources/views/components/admin/header/user-menu.blade.php -->

<div
    x-data="{ open: false }"
    class="relative flex items-center gap-3
           pl-3 border-l border-[var(--color-border-soft)]"
>
    <button
        @click="open = !open"
        @click.outside="open = false"
        class="flex items-center gap-2"
    >
        <img
            src="https://i.pinimg.com/736x/c4/34/d8/c434d8c366517ca20425bdc9ad8a32de.jpg"
            class="h-9 w-9 rounded-full object-cover
                   border border-[var(--color-border-soft)]"
            alt="Avatar"
        >

        <span class="hidden sm:block text-sm font-medium">
            {{ auth()->user()->name ?? 'Admin' }}
        </span>

        <svg class="hidden sm:block h-4 w-4"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div
        x-cloak
        x-show="open"
        x-transition
        class="absolute right-0 top-12 w-44
               rounded-lg
               admin-scope
               border border-[var(--color-border-soft)]
               shadow-lg py-1"
    >
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="w-full text-left px-4 py-2
                       text-sm text-red-400
                       hover:bg-[rgba(255,255,255,0.08)]"
            >
                Logout
            </button>
        </form>
    </div>
</div>
