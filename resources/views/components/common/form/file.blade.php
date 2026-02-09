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
               file:bg-btn-primary
               file:px-4 file:py-2
               file:text-btn-text
               hover:file:bg-btn-primary-hover"
    />
</div>
