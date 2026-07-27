{{-- Admin user form (create and edit). --}}
@props([
    'user' => null,
    'action',
    'method' => 'POST',
])

<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="grid grid-cols-1 gap-5">

        <x-common.form.input
            label="Name"
            name="name"
            :value="$user?->name"
            required
        />

        <x-common.form.input
            label="Email"
            name="email"
            type="email"
            :value="$user?->email"
            required
        />

        <x-common.form.input
            label="Password"
            name="password"
            type="password"
            :placeholder="$method === 'POST'
                ? 'Enter password'
                : 'Leave blank to keep current password'"
            :required="$method === 'POST'"
        />

        <x-common.form.radio-group
            label="Role"
            name="role"
            :value="$user?->role ?? 'user'"
            :options="[
                'admin' => 'Admin',
                'user'  => 'User'
            ]"
        />

        <div class="pt-4">
            <button class="btn-primary">
                {{ $method === 'POST' ? 'Save User' : 'Update User' }}
            </button>
        </div>

    </div>
</form>
