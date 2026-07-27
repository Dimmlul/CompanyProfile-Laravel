{{-- Auth pages: back-to-home button. --}}
@props(['href'])

<a href="{{ $href }}"
   class="absolute left-6 top-6 z-10 hidden items-center gap-2 rounded-lg border border-app-border
          bg-app-surface px-4 py-2 text-sm font-medium text-app-text transition hover:bg-app-surface-2 lg:inline-flex">
    &larr; Back
</a>
