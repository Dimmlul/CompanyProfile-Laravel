<!-- resources/views/components/auth/back-button.blade.php -->
@props(['href'])

<a href="{{ $href }}"
   class="hidden lg:inline-flex
          absolute left-6 top-6 z-10
          items-center rounded-lg
          bg-card px-5 py-2.5
          text-sm font-semibold text-app-text
          border border-card-border
          shadow hover:bg-gray-100 transition">
    ← Back
</a>
