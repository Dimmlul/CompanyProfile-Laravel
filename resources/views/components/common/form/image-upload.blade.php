@props([
    'label',
    'name',
    'current' => null, // path gambar lama (edit)
    'accept' => 'image/*',
])

<div class="space-y-2">
    <label class="block text-sm font-medium text-app-text">
        {{ $label }}
    </label>

    <div
        x-data="{
            preview: {{ $current ? '\'' . asset('storage/'.$current) . '\'' : 'null' }}
        }"
        class="space-y-3"
    >
        {{-- CURRENT / PREVIEW IMAGE --}}
        <template x-if="preview">
            <div class="relative inline-block">
                <img
                    :src="preview"
                    class="h-28 w-40 rounded-lg object-cover
                           border border-[var(--color-border-soft)]"
                >

                <button
                    type="button"
                    @click="preview = null"
                    class="absolute -top-2 -right-2
                           h-6 w-6 rounded-full
                           bg-black/70 text-white
                           text-xs flex items-center justify-center"
                    title="Remove preview"
                >
                    ✕
                </button>
            </div>
        </template>

        {{-- INPUT --}}
        <input
            type="file"
            name="{{ $name }}"
            accept="{{ $accept }}"
            @change="
                const file = $event.target.files[0];
                if (file) preview = URL.createObjectURL(file)
            "
            class="block w-full text-sm
                   file:mr-4
                   file:rounded-lg
                   file:border-0
                   file:bg-btn-primary
                   file:px-4 file:py-2
                   file:text-sm file:font-medium
                   file:text-btn-text
                   hover:file:bg-btn-primary-hover"
        >
    </div>

    @error($name)
        <p class="text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>
