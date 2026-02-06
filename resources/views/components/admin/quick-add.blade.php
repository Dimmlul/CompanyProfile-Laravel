@props(['type', 'label'])

<div x-data="{ open: false }">

    {{-- Trigger --}}
    <button
        type="button"
        @click="open = true"
        class="text-xs font-medium text-primary hover:underline"
    >
        {{ $label }}
    </button>

    {{-- MODAL ROOT (ISOLATED) --}}
    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-[9999] flex items-center justify-center"
        style="isolation:isolate"
    >
        {{-- Backdrop --}}
        <div
            class="absolute inset-0"
            style="background: rgba(0,0,0,0.75)"
            @click="open = false"
        ></div>

        {{-- MODAL BOX --}}
        <div
            class="relative w-full max-w-2xl rounded-2xl border border-gray-700 shadow-2xl"
            style="
                background-color: #0b1220;
                opacity: 1;
                backdrop-filter: none;
                -webkit-backdrop-filter: none;
            "
        >
            <div class="max-h-[80vh] overflow-y-auto p-6">

                {{-- ========== ARTICLE ========== --}}
                @if ($type === 'article')
                    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('pages.admin.articles._form')

                        <div class="mt-4 flex justify-end gap-3">
                            <button type="button" @click="open=false" class="text-sm text-gray-400 hover:text-white">
                                Cancel
                            </button>
                            <button type="submit"
                                class="rounded-lg bg-btn-primary px-4 py-2 text-sm font-medium text-btn-text hover:bg-btn-primary-hover">
                                Save Article
                            </button>
                        </div>
                    </form>
                @endif

                {{-- ========== PRODUCT ========== --}}
                @if ($type === 'product')
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('pages.admin.products._form')

                        <div class="mt-4 flex justify-end gap-3">
                            <button type="button" @click="open=false" class="text-sm text-gray-400 hover:text-white">
                                Cancel
                            </button>
                            <button type="submit"
                                class="rounded-lg bg-btn-primary px-4 py-2 text-sm font-medium text-btn-text hover:bg-btn-primary-hover">
                                Save Product
                            </button>
                        </div>
                    </form>
                @endif

                {{-- ========== EVENT ========== --}}
                @if ($type === 'event')
                    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('pages.admin.events._form')

                        <div class="mt-4 flex justify-end gap-3">
                            <button type="button" @click="open=false" class="text-sm text-gray-400 hover:text-white">
                                Cancel
                            </button>
                            <button type="submit"
                                class="rounded-lg bg-btn-primary px-4 py-2 text-sm font-medium text-btn-text hover:bg-btn-primary-hover">
                                Save Event
                            </button>
                        </div>
                    </form>
                @endif

                {{-- ========== GALLERY ========== --}}
                @if ($type === 'gallery')
                    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('pages.admin.gallery._form')

                        <div class="mt-4 flex justify-end gap-3">
                            <button type="button" @click="open=false" class="text-sm text-gray-400 hover:text-white">
                                Cancel
                            </button>
                            <button type="submit"
                                class="rounded-lg bg-btn-primary px-4 py-2 text-sm font-medium text-btn-text hover:bg-btn-primary-hover">
                                Save Image
                            </button>
                        </div>
                    </form>
                @endif

                {{-- ========== CLIENT ========== --}}
                @if ($type === 'client')
                    <form method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('pages.admin.clients._form')

                        <div class="mt-4 flex justify-end gap-3">
                            <button type="button" @click="open=false" class="text-sm text-gray-400 hover:text-white">
                                Cancel
                            </button>
                            <button type="submit"
                                class="rounded-lg bg-btn-primary px-4 py-2 text-sm font-medium text-btn-text hover:bg-btn-primary-hover">
                                Save Client
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
</div>
