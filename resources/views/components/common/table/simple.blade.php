{{-- Reusable admin table shell: renders headers, leaves row markup to the caller's slot. --}}

@props([
    'headers' => [],
])

<div class="overflow-x-auto">
    <table class="admin-table">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
