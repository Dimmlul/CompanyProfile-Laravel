@props([
    'action',
    'method' => 'POST',
    'client' => null,
])

<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="grid grid-cols-1 gap-5">

        <x-common.form.input
            label="Client Name"
            name="name"
            :value="$client?->name"
        />

        {{-- LOGO --}}
        <div class="space-y-2">
            <label class="block text-sm font-medium text-app-text">
                Logo
            </label>

            @if ($client?->logo)
                <img
                    src="{{ asset('storage/'.$client->logo) }}"
                    class="h-16 object-contain rounded border border-white/10"
                >
            @endif

            <input type="file" name="logo" class="form-input">
        </div>

        <x-common.form.input
            label="Website"
            name="website"
            type="url"
            :value="$client?->website"
        />

        <x-common.form.textarea
            label="Description"
            name="description"
            rows="3"
            :value="$client?->description"
        />

        {{-- STATUS --}}
        <div>
            <label class="block text-sm font-medium text-app-text mb-2">
                Status
            </label>

            <div class="flex gap-6 text-sm">
                <label class="flex items-center gap-2">
                    <input type="radio" name="is_active" value="1"
                        {{ old('is_active', $client?->is_active ?? 1) == 1 ? 'checked' : '' }}>
                    Active
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="is_active" value="0"
                        {{ old('is_active', $client?->is_active ?? 1) == 0 ? 'checked' : '' }}>
                    Inactive
                </label>
            </div>
        </div>

        {{-- ORDER POSITION (EDIT ONLY) --}}
        @if ($method !== 'POST')
            <div class="space-y-2">
                <label class="block text-sm font-medium text-app-text">
                    Order Position
                </label>

                <select name="order_action" class="form-input">
                    <option value="">Keep current position</option>
                    <option value="top">Move to top</option>
                    <option value="up">Move up</option>
                    <option value="down">Move down</option>
                    <option value="bottom">Move to bottom</option>
                </select>
            </div>
        @endif

        <x-common.form.submit
            :label="$method === 'POST' ? 'Save Client' : 'Update Client'"
        />

    </div>
</form>
