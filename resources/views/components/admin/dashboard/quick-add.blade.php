<!-- resources/views/components/admin/dashboard/quick-add.blade.php -->

@props([
    'type',
    'label' => 'Add',
])

<div x-data="{ open: false }">

    {{-- BUTTON --}}
    <button
        type="button"
        @click="open = true"
        class="inline-flex items-center gap-2
               rounded-lg border border-app-border
               bg-app-surface-2 px-4 py-2
               text-sm text-app-text
               hover:bg-app-surface-2 transition"
    >
        + {{ $label }}
    </button>

    {{-- MODAL --}}
    <template x-teleport="body">
        <div
            x-show="open"
            x-cloak
            class="fixed inset-0 z-[9999] flex items-center justify-center"
        >
            {{-- BACKDROP --}}
            <div
                class="absolute inset-0 bg-black/80"
                @click="open = false"
            ></div>

            {{-- MODAL BOX --}}
            <div class="surface relative w-full max-w-2xl rounded-2xl shadow-2xl">
                <div class="flex items-center justify-between border-b border-app-border px-6 py-4">
                    <h3 class="text-sm font-semibold text-app-heading">Add {{ $label }}</h3>
                    <button type="button" @click="open = false" class="text-app-muted transition hover:text-app-heading">&times;</button>
                </div>

                {{-- Reuses the same self-contained form component as the create page --}}
                <div class="max-h-[80vh] overflow-y-auto p-6">
                    @switch($type)
                        @case('article')
                            <x-admin.article.form :action="route('admin.articles.store')" />
                            @break
                        @case('product')
                            <x-admin.product.form :action="route('admin.products.store')" />
                            @break
                        @case('event')
                            <x-admin.event.form :action="route('admin.events.store')" />
                            @break
                        @case('gallery')
                            <x-admin.gallery.form :action="route('admin.gallery.store')" />
                            @break
                        @case('client')
                            <x-admin.client.form :action="route('admin.clients.store')" />
                            @break
                    @endswitch
                </div>
            </div>
        </div>
    </template>

</div>
