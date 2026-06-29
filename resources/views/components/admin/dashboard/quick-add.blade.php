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
               rounded-lg border border-white/10
               bg-white/5 px-4 py-2
               text-sm text-app-text
               hover:bg-white/10 transition"
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
            <div
                class="relative w-full max-w-2xl rounded-2xl
                       border border-white/10 bg-card-bg
                       shadow-2xl"
            >
                <div class="max-h-[80vh] overflow-y-auto p-6">

                    {{-- ARTICLE --}}
                    @if ($type === 'article')
                        <form method="POST"
                              action="{{ route('admin.articles.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            @include('pages.admin.articles._form')
                            @include('pages.admin.partials.modal-actions', [
                                'label' => 'Save Article'
                            ])
                        </form>
                    @endif

                    {{-- PRODUCT --}}
                    @if ($type === 'product')
                        <form method="POST"
                              action="{{ route('admin.products.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            @include('pages.admin.products._form')
                            @include('pages.admin.partials.modal-actions', [
                                'label' => 'Save Product'
                            ])
                        </form>
                    @endif

                    {{-- EVENT --}}
                    @if ($type === 'event')
                        <form method="POST"
                              action="{{ route('admin.events.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            @include('pages.admin.events._form')
                            @include('pages.admin.partials.modal-actions', [
                                'label' => 'Save Event'
                            ])
                        </form>
                    @endif

                    {{-- GALLERY --}}
                    @if ($type === 'gallery')
                        <form method="POST"
                              action="{{ route('admin.gallery.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            @include('pages.admin.gallery._form')
                            @include('pages.admin.partials.modal-actions', [
                                'label' => 'Save Image'
                            ])
                        </form>
                    @endif

                    {{-- CLIENT --}}
                    @if ($type === 'client')
                        <form method="POST"
                              action="{{ route('admin.clients.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            @include('pages.admin.clients._form')
                            @include('pages.admin.partials.modal-actions', [
                                'label' => 'Save Client'
                            ])
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </template>

</div>
