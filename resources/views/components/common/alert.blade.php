{{-- Flash message alert box. --}}
@props([
    'type' => 'error', // error | success | info
])

@php
    $styles = match ($type) {
        'success' => 'border-green-500/20 bg-green-500/10 text-green-400',
        'info'    => 'border-blue-500/20 bg-blue-500/10 text-blue-400',
        default   => 'border-red-500/20 bg-red-500/10 text-red-400',
    };
@endphp

@if ($type === 'error' && $errors->any())
    <div class="mb-4 rounded-xl border px-4 py-3 text-sm {{ $styles }}">
        @foreach ($errors->all() as $error)
            <p>• {{ $error }}</p>
        @endforeach
    </div>
@endif

@if ($type !== 'error' && session($type))
    <div class="mb-4 rounded-xl border px-4 py-3 text-sm {{ $styles }}">
        {{ session($type) }}
    </div>
@endif
