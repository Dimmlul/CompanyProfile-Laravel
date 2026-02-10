@props([
    'name',
    'class' => 'h-5 w-5'
])

@switch($name)

{{-- ================= DASHBOARD ================= --}}
@case('dashboard')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z"/>
</svg>
@break


{{-- ================= COMPANY ================= --}}
@case('company')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M3 21h18M4 21V4a1 1 0 011-1h14a1 1 0 011 1v17"/>
</svg>
@break


{{-- ================= ORDERS ================= --}}
@case('orders')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 8h14l-1.5 12.5a2 2 0 01-2 1.5H8.5a2 2 0 01-2-1.5L5 8z"/>
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M9 8V6a3 3 0 016 0v2"/>
</svg>
@break


{{-- ================= INBOX ================= --}}
@case('inbox')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M21 12c0 4.418-4.03 8-9 8
           a9.77 9.77 0 01-4-.8L3 20l1.8-4
           A7.82 7.82 0 013 12
           c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
</svg>
@break


{{-- ================= USER (MULTIPLE USERS) ================= --}}
@case('user')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    {{-- Left person --}}
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M9 7a3 3 0 100 6 3 3 0 000-6z"/>
    {{-- Right person --}}
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M15 7a3 3 0 100 6 3 3 0 000-6z"/>
    {{-- Group body --}}
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M3 21a6 6 0 0112 0M9 21a6 6 0 0112 0"/>
</svg>
@break


{{-- ================= ARTICLE ================= --}}
@case('article')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M7 7h10M7 11h10M7 15h6"/>
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
</svg>
@break


{{-- ================= PRODUCT ================= --}}
@case('product')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M12 2l9 5-9 5-9-5 9-5z"/>
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M3 7v10l9 5 9-5V7"/>
</svg>
@break


{{-- ================= EVENT ================= --}}
@case('event')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M8 7V3m8 4V3M4 11h16"/>
    <rect x="3" y="7" width="18" height="14" rx="2"/>
</svg>
@break


{{-- ================= GALLERY ================= --}}
@case('gallery')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <rect x="3" y="3" width="18" height="18" rx="2"/>
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M4 16l4-4a3 3 0 014 0l4 4"/>
    <circle cx="15" cy="9" r="2"/>
</svg>
@break


{{-- ================= CLIENT (SINGLE PERSON) ================= --}}
@case('client')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    {{-- Head --}}
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M12 7a4 4 0 100 8 4 4 0 000-8z"/>
    {{-- Body --}}
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 21a7 7 0 0114 0"/>
</svg>
@break

{{-- ================= CART ================= --}}
@case('cart')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
    <circle cx="7" cy="21" r="1"/>
    <circle cx="17" cy="21" r="1"/>
</svg>
@break

{{-- ================= CHECKOUT ================= --}}
@case('checkout')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M5 8h14M5 12h14M5 16h10"/>
</svg>
@break

{{-- ================= PAYMENT ================= --}}
@case('payment')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <rect x="2" y="5" width="20" height="14" rx="2"/>
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M2 10h20"/>
</svg>
@break

{{-- ================= SECURE ================= --}}
@case('secure')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 11c1.1 0 2 .9 2 2v2a2 2 0 11-4 0v-2c0-1.1.9-2 2-2z"/>
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M6 11V8a6 6 0 0112 0v3"/>
</svg>
@break

{{-- ================= EMAIL ================= --}}
@case('email')
<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M4 4h16v16H4V4z"/>
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M22 6l-10 7L2 6"/>
</svg>
@break


@endswitch
