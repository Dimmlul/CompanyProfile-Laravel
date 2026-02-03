@extends('layouts.app')

@section('title','Complete Payment')

@section('content')
<section class="py-24 bg-app-bg">
    <div class="max-w-xl mx-auto px-6">

        <div class="bg-card border border-card-border rounded-2xl p-8 text-center">

            <h1 class="text-2xl font-semibold text-white mb-2">
                Complete Your Payment
            </h1>

            <p class="text-app-muted mb-6">
                Order ID: <span class="text-white">{{ $order->order_number }}</span>
            </p>

            <div class="bg-app-bg rounded-xl p-5 mb-6">
                <p class="text-sm text-app-muted">Total Payment</p>
                <p class="text-3xl font-bold text-white">
                    Rp {{ number_format($order->total) }}
                </p>
            </div>

            <button
                id="pay-button"
                type="button"
                class="w-full py-3 rounded-xl bg-indigo-500 text-white
                       hover:bg-indigo-600 transition font-medium">
                Pay with Midtrans
            </button>

            <p class="text-xs text-app-muted mt-4">
                Secure payment powered by Midtrans
            </p>

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

        // ⛔ cegah double klik / double state
        if (snapOpened) return;

        snapOpened = true;
        payButton.disabled = true;
        payButton.innerText = 'Processing...';

        snap.pay('{{ $order->payment_token }}', {
            onSuccess: function () {
                window.location.href = "{{ route('orders.index') }}";
            },
            onPending: function () {
                window.location.href = "{{ route('orders.index') }}";
            },
            onError: function () {
                resetButton();
                alert('Payment failed');
            },
            onClose: function () {
                resetButton();
            }
        });
    });

    function resetButton() {
        snapOpened = false;
        payButton.disabled = false;
        payButton.innerText = 'Pay with Midtrans';
    }
})();
</script>
@endpush
