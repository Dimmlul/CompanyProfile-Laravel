@extends('layouts.app')

@section('title','Complete Payment')

@section('content')
<section class="py-24 bg-app-bg">
    <div class="max-w-xl mx-auto px-6">

        <div class="surface relative overflow-hidden rounded-2xl p-8 text-center shadow-lg">

            {{-- Decorative gradient --}}
            <div class="pointer-events-none absolute inset-x-0 -top-24 h-48 bg-gradient-to-b from-brand-main/20 to-transparent"></div>

            {{-- Header --}}
            <div class="relative">
                <h1 class="mb-2 text-2xl font-semibold text-app-heading">Complete Your Payment</h1>
                <p class="mb-6 text-sm text-app-muted">
                    Order ID:
                    <span class="font-medium text-app-heading">{{ $order->order_number }}</span>
                </p>
            </div>

            {{-- Amount --}}
            <div class="relative mb-6 rounded-xl border border-app-border bg-app-surface-2 p-6">
                <p class="text-sm text-app-muted">Total Payment</p>
                <p class="mt-1 text-3xl font-bold tracking-wide text-app-heading">Rp {{ number_format($order->total) }}</p>
            </div>

            {{-- Pay Button --}}
            <button
                id="pay-button"
                type="button"
                class="group btn-primary w-full py-3.5 disabled:cursor-not-allowed disabled:opacity-60"
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
            {{-- debugging --}}
            {{-- <p class="text-xs text-red-400">
                SNAP TOKEN: {{ $order->payment_token ?? 'NULL' }}
            </p> --}}

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
      data-client-key="{{ config('services.midtrans.client_key') }}">
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
