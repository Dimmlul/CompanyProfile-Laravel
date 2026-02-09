@props([
    'name',
    'class' => 'h-5 w-5'
])

@switch($name)

    {{-- DASHBOARD --}}
    @case('dashboard')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z"/>
        </svg>
        @break

    {{-- COMPANY --}}
    @case('company')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 21h18M9 8h1m4 0h1M4 21V4a1 1 0 011-1h14a1 1 0 011 1v17"/>
        </svg>
        @break

    {{-- ORDERS --}}
    @case('orders')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 7h18M5 7l1.5 12.5a2 2 0 002 1.5h7a2 2 0 002-1.5L19 7"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 7V5a3 3 0 016 0v2"/>
        </svg>
        @break

    {{-- INBOX --}}
    @case('inbox')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8 10h.01M12 10h.01M16 10h.01M21 12
                     c0 4.418-4.03 8-9 8
                     a9.77 9.77 0 01-4-.8
                     L3 20l1.8-4
                     A7.82 7.82 0 013 12
                     c0-4.418 4.03-8 9-8
                     s9 3.582 9 8z"/>
        </svg>
        @break

    {{-- ARTICLES --}}
    @case('article')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M7 7h10M7 11h10M7 15h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
        </svg>
        @break

    {{-- PRODUCTS --}}
    @case('product')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 2l9 5-9 5-9-5 9-5z"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 12l9 5 9-5"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 17l9 5 9-5"/>
        </svg>
        @break

    {{-- EVENTS --}}
    @case('event')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8 7V3m8 4V3M4 11h16M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        @break

    {{-- GALLERY --}}
    @case('gallery')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 16l4-4a3 3 0 014 0l4 4"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2 6a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
        </svg>
        @break

    {{-- CLIENTS --}}
    @case('clients')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17 20v-2a4 4 0 00-3-3.87M7 20v-2a4 4 0 013-3.87"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 7a4 4 0 108 0 4 4 0 00-8 0z"/>
        </svg>
        @break

@endswitch
