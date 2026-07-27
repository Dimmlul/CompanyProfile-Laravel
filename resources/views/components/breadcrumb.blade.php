{{-- Breadcrumb navigation trail. --}}
@props([
    'items' => [],   // [ ['label' => '...', 'href' => '...'(optional)], ... ] — last item is the current page
])

<nav aria-label="Breadcrumb" {{ $attributes }}>
    <ol class="flex flex-wrap items-center gap-2 text-sm">
        @foreach ($items as $item)
            <li class="flex items-center gap-2">
                @if (!empty($item['href']) && !$loop->last)
                    <a href="{{ $item['href'] }}" class="text-app-muted transition hover:text-app-heading">{{ $item['label'] }}</a>
                @else
                    <span class="max-w-[16rem] truncate font-medium text-app-heading" aria-current="page">{{ $item['label'] }}</span>
                @endif

                @unless ($loop->last)
                    <svg class="h-3.5 w-3.5 text-app-muted/50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                @endunless
            </li>
        @endforeach
    </ol>
</nav>
