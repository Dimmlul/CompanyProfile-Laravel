@props(['href'])

<a href="{{ $href }}"
   class="hidden lg:inline-flex
          absolute left-6 top-6 z-10
          items-center gap-2
          rounded-lg border border-white/10
          bg-slate-900/70 px-4 py-2
          text-sm font-medium text-app-text
          hover:bg-slate-900 transition">
    ← Back
</a>
