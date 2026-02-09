<!-- ================= LIVE SUPPORT ================= -->
@php
    // 🔑 Ambil token chat guest dari cookie
    $chatToken = request()->cookie('support_chat_token');

    // 📞 WhatsApp dari DB
    $waLink = filled($companyProfile->whatsapp)
        ? 'https://wa.me/' . preg_replace('/\D/', '', $companyProfile->whatsapp)
        : null;
@endphp

<div
    id="live-support"
    style="position:fixed;bottom:150px;right:32px;z-index:99999;"
    class="relative"
>
    <!-- BUTTON -->
    <button
        type="button"
        onclick="toggleSupport()"
        style="background:#4f46e5"
        class="group flex items-center gap-3
               rounded-full
               px-5 py-3
               text-sm font-semibold text-white
               shadow-lg shadow-indigo-600/40
               transition-all duration-300
               hover:-translate-y-0.5"
    >
        <!-- ICON -->
        <span
            class="flex h-10 w-10 items-center justify-center
                   rounded-full bg-white"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="18" height="18"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="#1e293b"
                 stroke-width="2.5"
                 stroke-linecap="round"
                 stroke-linejoin="round">
                <path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
            </svg>
        </span>

        <span class="hidden sm:block">
            Got Questions?
        </span>
    </button>

    <!-- DROPDOWN -->
    <div
        id="support-dropdown"
        class="absolute right-0 top-0 hidden
               w-80 max-h-[70vh]
               overflow-y-auto
               rounded-2xl
               border border-white/10
               shadow-2xl
               -translate-y-full -translate-y-4"
        style="background:#020617"
    >
        <!-- HEADER -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-white/10">
            <div>
                <p class="text-sm font-semibold text-white">
                    Customer Support
                </p>
                <p class="text-xs text-slate-400">
                    We’re online & ready to help
                </p>
            </div>

            <button
                type="button"
                onclick="closeSupport()"
                class="text-slate-400 hover:text-white transition"
            >
                ✕
            </button>
        </div>

        <!-- BODY -->
        <div class="px-5 py-4 space-y-3">

            <!-- CHAT WITH ADMIN / CONTINUE CHAT -->
            <a
                href="{{ $chatToken
                    ? route('client.messages.show', $chatToken)
                    : route('client.messages.start') }}"
                class="flex items-center justify-center gap-3
                       rounded-xl py-3
                       text-sm font-semibold text-white
                       transition"
                style="background:#4f46e5"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="18" height="18"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="white"
                     stroke-width="2.5"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
                </svg>

                {{ $chatToken ? 'Continue Chat' : 'Chat with Admin' }}
            </a>

            <!-- RESET CHAT (OPSIONAL TAPI DISARANKAN) -->
            {{-- @if ($chatToken)
                <form method="POST" action="{{ route('client.messages.reset') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full flex items-center justify-center gap-2
                               rounded-xl py-2.5
                               text-sm text-slate-300
                               hover:text-white
                               hover:bg-white/5 transition"
                    >
                        🗑 Start New Chat
                    </button>
                </form>
            @endif --}}

            <!-- WHATSAPP -->
            <a
                href="{{ $waLink ?? '#' }}"
                @if($waLink) target="_blank" @endif
                class="flex items-center justify-center gap-3
                       rounded-xl py-3
                       text-sm font-semibold text-white
                       transition hover:opacity-95
                       {{ $waLink ? '' : 'opacity-50 pointer-events-none' }}"
                style="background:#25D366"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="18" height="18"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="white"
                     stroke-width="2.5"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="M22 16.92V21a2 2 0 0 1-2.18 2A19.86 19.86 0 0 1 3 5.18
                             2 2 0 0 1 5 3h4.09a2 2 0 0 1 2 1.72
                             c.12.81.37 1.6.73 2.34
                             a2 2 0 0 1-.45 2.11L10.91 10.91
                             a16 16 0 0 0 6.18 6.18l1.74-1.74
                             a2 2 0 0 1 2.11-.45
                             c.74.36 1.53.61 2.34.73
                             a2 2 0 0 1 1.72 1.99z"/>
                </svg>

                {{ $waLink ? 'Chat via WhatsApp' : 'WhatsApp not available' }}
            </a>

            <!-- CONTACT PAGE -->
            <a
                href="{{ route('contact') }}"
                class="flex items-center justify-center gap-3
                       rounded-xl py-3
                       text-sm font-medium text-white
                       transition hover:bg-[#111827]"
                style="background:#0b1220"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="18" height="18"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="white"
                     stroke-width="2.5"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <path d="m22 6-10 7L2 6"/>
                </svg>
                Contact Page
            </a>
        </div>
    </div>
</div>

<!-- ================= JS ================= -->
<script>
function toggleSupport() {
    document.getElementById('support-dropdown')
        .classList.toggle('hidden')
}

function closeSupport() {
    document.getElementById('support-dropdown')
        .classList.add('hidden')
}

document.addEventListener('click', function (e) {
    const wrapper = document.getElementById('live-support')
    if (!wrapper.contains(e.target)) {
        closeSupport()
    }
})
</script>
<!-- ============================================================ -->
