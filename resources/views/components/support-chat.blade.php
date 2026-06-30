@php
    $chatToken = request()->cookie('support_chat_token');

    $waLink = filled($companyProfile->whatsapp)
        ? 'https://wa.me/' . preg_replace('/\D/', '', $companyProfile->whatsapp)
        : null;
@endphp

<div
    x-data="{ open: false }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
    class="fixed bottom-24 right-8 z-[9999]"
>
    {{-- Toggle button --}}
    <button
        type="button"
        @click="open = !open"
        class="flex items-center gap-3 rounded-full bg-brand-main px-5 py-3 text-sm font-semibold
               text-white shadow-lg shadow-indigo-600/40 transition hover:-translate-y-0.5"
    >
        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1e293b"
                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
            </svg>
        </span>
        <span class="hidden sm:block">Support Chat</span>
    </button>

    {{-- Panel (opens upward, above the button) --}}
    <div
        x-show="open"
        x-transition
        x-cloak
        class="surface absolute bottom-full right-0 mb-3 w-80 overflow-hidden rounded-2xl shadow-2xl"
    >
        <div class="flex items-center justify-between border-b border-app-border px-5 py-4">
            <div>
                <p class="text-sm font-semibold text-app-heading">Customer Support</p>
                <p class="text-xs text-app-muted">We're online &amp; ready to help</p>
            </div>
            <button type="button" @click="open = false" class="text-app-muted transition hover:text-app-heading">
                &times;
            </button>
        </div>

        <div class="space-y-3 px-5 py-4">
            {{-- Live chat with admin --}}
            <a
                href="{{ $chatToken ? route('client.messages.show', $chatToken) : route('client.messages.start') }}"
                class="flex items-center justify-center gap-3 rounded-xl bg-brand-main py-3 text-sm font-semibold text-white transition"
            >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
                </svg>
                {{ $chatToken ? 'Continue Chat' : 'Chat with Admin' }}
            </a>

            {{-- WhatsApp --}}
            <a
                href="{{ $waLink ?? '#' }}"
                @if($waLink) target="_blank" rel="noopener" @endif
                class="flex items-center justify-center gap-3 rounded-xl bg-[#25D366] py-3 text-sm font-semibold
                       text-white transition hover:opacity-95 {{ $waLink ? '' : 'pointer-events-none opacity-50' }}"
            >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92V21a2 2 0 0 1-2.18 2A19.86 19.86 0 0 1 3 5.18 2 2 0 0 1 5 3h4.09a2 2 0 0 1 2 1.72c.12.81.37 1.6.73 2.34a2 2 0 0 1-.45 2.11L10.91 10.91a16 16 0 0 0 6.18 6.18l1.74-1.74a2 2 0 0 1 2.11-.45c.74.36 1.53.61 2.34.73a2 2 0 0 1 1.72 1.99z"/>
                </svg>
                {{ $waLink ? 'Chat via WhatsApp' : 'WhatsApp not available' }}
            </a>

            {{-- Contact page --}}
            <a
                href="{{ route('contact') }}"
                class="flex items-center justify-center gap-3 rounded-xl bg-app-surface-2 py-3 text-sm font-medium text-app-heading transition hover:opacity-90"
            >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <path d="m22 6-10 7L2 6"/>
                </svg>
                Send Email
            </a>
        </div>
    </div>
</div>
