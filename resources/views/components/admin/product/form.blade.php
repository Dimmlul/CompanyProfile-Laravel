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

<div class="grid grid-cols-1 gap-5">

    {{-- NAME --}}
    <x-common.form.input
        label="Product Name"
        name="name"
        :value="$product?->name"
    />

    {{-- SHORT DESCRIPTION --}}
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

    {{-- IMAGE + PREVIEW --}}
    <div
        x-data="{
            preview: '{{ $product?->image ? asset('storage/'.$product->image) : '' }}'
        }"
        class="space-y-2"
    >
        <label class="text-sm font-medium text-app-text">
            Image
        </label>

        <template x-if="preview">
            <img
                :src="preview"
                class="h-24 w-32 rounded-lg object-cover border border-white/10"
            >
        </template>

        <input
            type="file"
            name="image"
            accept="image/*"
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

    {{-- STATUS --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-app-text">
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

{{-- ORDER POSITION (EDIT ONLY) --}}
@if ($showOrder)
    <div class="space-y-2">
        <label class="block text-sm font-medium text-app-text">
            Order Position
        </label>

        <select
            name="order_action"
            class="form-input"
        >
            <option value="">
                Keep current position
            </option>

            <option value="top">
                Move to top
            </option>

            <option value="up">
                Move up
            </option>

            <option value="down">
                Move down
            </option>

            <option value="bottom">
                Move to bottom
            </option>
        </select>

        <p class="text-xs text-app-muted">
            This will change the product order relative to other products.
        </p>
    </div>
@endif


    {{-- SUBMIT --}}
    <x-common.form.submit
        :label="$method === 'POST' ? 'Save Product' : 'Update Product'"
    />

</div>
</form>
