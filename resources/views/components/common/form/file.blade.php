@props(['label','name'])

<div class="space-y-1">
    <label class="text-xs font-medium text-app-muted">
        {{ $label }}
    </label>

    <input
        type="file"
        name="{{ $name }}"
        class="block w-full text-sm
               file:rounded-md
               file:bg-brand-main
               file:px-4 file:py-2
               file:text-brand-text
               hover:file:bg-brand-hover"
    />
</div>
