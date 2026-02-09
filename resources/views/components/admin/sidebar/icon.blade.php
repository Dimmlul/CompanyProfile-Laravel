@props([
    'name',
    'class' => 'h-5 w-5'
])

@switch($name)

@case('dashboard')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z"/>
</svg>
@break

@case('company')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M3 21h18M4 21V4a1 1 0 011-1h14a1 1 0 011 1v17"/>
</svg>
@break

@case('orders')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M5 8h14l-1.5 12.5a2 2 0 01-2 1.5H8.5a2 2 0 01-2-1.5L5 8z"/>
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M9 8V6a3 3 0 016 0v2"/>
</svg>
@break

@case('inbox')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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

@case('article')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M7 7h10M7 11h10M7 15h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
</svg>
@break

@case('product')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 2l9 5-9 5-9-5 9-5z"/>
</svg>
@break

@case('event')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M8 7V3m8 4V3M4 11h16"/>
</svg>
@break

@case('gallery')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M4 16l4-4a3 3 0 014 0l4 4"/>
</svg>
@break

@case('client')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M17 20v-2a4 4 0 00-3-3.87"/>
</svg>
@break

@endswitch
