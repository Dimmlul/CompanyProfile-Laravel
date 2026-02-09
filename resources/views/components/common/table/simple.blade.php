<!-- resources/views/components/common/table/simple.blade.php -->

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
