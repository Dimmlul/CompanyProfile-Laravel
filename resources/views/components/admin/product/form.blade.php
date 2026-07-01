@props([
    'action',
    'method' => 'POST',
    'product' => null,
    'showOrder' => false,
])

<form
    method="POST"
    action="{{ $action }}"
    enctype="multipart/form-data"
>
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div
        x-data="{
            delivery: '{{ old('delivery_type', $product->delivery_type ?? 'file') }}'
        }"
        class="grid grid-cols-1 gap-5"
    >

        {{-- NAME --}}
        <x-common.form.input
            label="Product Name"
            name="name"
            :value="$product?->name"
        />

        {{-- DESCRIPTION --}}
        <x-common.form.textarea
            label="Short Description"
            name="description"
            rows="3"
            :value="$product?->description"
        />

        {{-- CONTENT --}}
        <x-common.form.textarea
            label="Content"
            name="content"
            rows="6"
            :value="$product?->content"
        />

        {{-- IMAGE --}}
        <div
            x-data="{ preview: '{{ $product?->image ? asset('storage/'.$product->image) : '' }}' }"
            class="space-y-2"
        >
            <label class="text-sm font-medium text-app-heading">
                Preview Image
            </label>

            <template x-if="preview">
                <img
                    :src="preview"
                    class="h-24 w-32 rounded-lg object-cover border border-app-border"
                >
            </template>

            <input
                type="file"
                name="image"
                class="form-input"
                @change="preview = URL.createObjectURL($event.target.files[0])"
            >
        </div>

        {{-- PRICE --}}
        <x-common.form.input
            label="Price"
            name="price"
            type="number"
            :value="$product?->price"
        />

        {{-- DELIVERY TYPE --}}
        <div class="space-y-2">
            <label class="block text-sm font-medium text-app-heading">
                Delivery Type
            </label>

            <div class="flex gap-6 text-sm">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        name="delivery_type"
                        value="file"
                        x-model="delivery"
                    >
                    Upload File
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        name="delivery_type"
                        value="link"
                        x-model="delivery"
                    >
                    External Link
                </label>
            </div>
        </div>

        {{-- FILE UPLOAD --}}
        <div x-show="delivery === 'file'" x-transition>
            <label class="block text-sm font-medium text-app-heading mb-1">
                Template File (ZIP / RAR)
            </label>

            @if ($product?->download_path)
                <p class="mb-2 text-xs text-app-muted">
                    Current file:
                    <a
                        href="{{ asset('storage/'.$product->download_path) }}"
                        target="_blank"
                        class="text-brand-accent underline"
                    >
                        Download
                    </a>
                </p>
            @endif

            <input
                type="file"
                name="file"
                accept=".zip,.rar"
                class="form-input"
            >
        </div>

        {{-- DOWNLOAD LINK --}}
        <div x-show="delivery === 'link'" x-transition>
            <x-common.form.input
                label="Download URL"
                name="download_url"
                placeholder="https://drive.google.com / github / figma"
                :value="$product?->download_url"
            />
        </div>

        {{-- STATUS --}}
        <div>
            <label class="block text-sm font-medium text-app-heading mb-2">
                Status
            </label>

            <div class="flex gap-6 text-sm">
                <label class="flex items-center gap-2">
                    <input
                        type="radio"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $product?->is_active ?? 1) == 1 ? 'checked' : '' }}
                    >
                    Active
                </label>

                <label class="flex items-center gap-2">
                    <input
                        type="radio"
                        name="is_active"
                        value="0"
                        {{ old('is_active', $product?->is_active ?? 1) == 0 ? 'checked' : '' }}
                    >
                    Inactive
                </label>
            </div>
        </div>

        {{-- ORDER --}}
        @if ($showOrder)
            <div>
                <label class="block text-sm font-medium text-app-heading mb-2">
                    Order Position
                </label>

                <select name="order_action" class="form-input">
                    <option value="">Keep current</option>
                    <option value="top">Move to top</option>
                    <option value="up">Move up</option>
                    <option value="down">Move down</option>
                    <option value="bottom">Move to bottom</option>
                </select>
            </div>
        @endif

        {{-- SUBMIT --}}
        <x-common.form.submit
            :label="$method === 'POST' ? 'Save Product' : 'Update Product'"
        />

    </div>
</form>
