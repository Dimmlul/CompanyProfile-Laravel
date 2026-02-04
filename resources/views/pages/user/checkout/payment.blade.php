@extends('layouts.app')

@section('title','Complete Payment')

@section('content')
<section class="py-24 bg-app-bg">
    <div class="max-w-xl mx-auto px-6">

        <div
            class="relative overflow-hidden
                   bg-card border border-card-border
                   rounded-2xl p-8 text-center
                   shadow-lg"
        >

            {{-- Decorative gradient --}}
            <div
                class="pointer-events-none absolute inset-x-0 -top-24 h-48
                       bg-gradient-to-b from-indigo-500/20 to-transparent">
            </div>

            {{-- Header --}}
            <div class="relative">
                <h1 class="text-2xl font-semibold text-white mb-2">
                    Complete Your Payment
                </h1>

                <p class="text-app-muted text-sm mb-6">
                    Order ID:
                    <span class="text-white font-medium">
                        {{ $order->order_number }}
                    </span>
                </p>
            </div>

            {{-- Amount --}}
            <div
                class="relative rounded-xl
                       bg-app-bg border border-card-border
                       p-6 mb-6"
            >
                <p class="text-sm text-app-muted">
                    Total Payment
                </p>

                <p class="mt-1 text-3xl font-bold text-white tracking-wide">
                    Rp {{ number_format($order->total) }}
                </p>
            </div>

            {{-- Pay Button --}}
            <button
                id="pay-button"
                type="button"
                class="group relative w-full
                       py-3.5 rounded-xl
                       bg-indigo-500 text-white
                       font-semibold
                       transition-all duration-200
                       hover:bg-indigo-600
                       active:scale-[0.98]
                       disabled:opacity-60 disabled:cursor-not-allowed"
            >
                <span class="flex items-center justify-center gap-2">
                    <svg
                        class="h-5 w-5 transition-transform
                               group-hover:translate-x-0.5"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                    Pay with Midtrans
                </span>
            </button>

            {{-- Info --}}
            <div class="mt-5 space-y-1">
                <p class="text-xs text-app-muted">
                    Secure payment powered by Midtrans
                </p>
                <p class="text-xs text-app-muted">
                    You’ll be redirected to a secure payment popup
                </p>
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
(function () {
    const payButton = document.getElementById('pay-button');
    let snapOpened = false;

    if (!payButton) return;

    payButton.addEventListener('click', function () {

        // ⛔ cegah double klik
        if (snapOpened) return;

        snapOpened = true;
        payButton.disabled = true;

        payButton.innerHTML = `
            <span class="flex items-center justify-center gap-2">
                <svg class="h-5 w-5 animate-spin"
                     fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4v4m0 8v4m8-8h-4M8 12H4"/>
                </svg>
                Processing Payment...
            </span>
        `;

        snap.pay('{{ $order->payment_token }}', {
            onSuccess: function () {
                window.location.href = "{{ route('orders.index') }}";
            },
            onPending: function () {
                window.location.href = "{{ route('orders.index') }}";
            },
            onError: function () {
                resetButton();
                alert('Payment failed. Please try again.');
            },
            onClose: function () {
                resetButton();
            }
        });
    });

    function resetButton() {
        snapOpened = false;
        payButton.disabled = false;
        payButton.innerHTML = `
            <span class="flex items-center justify-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4v16m8-8H4"/>
                </svg>
                Pay with Midtrans
            </span>
        `;
    }
})();
</script>
@endpush
