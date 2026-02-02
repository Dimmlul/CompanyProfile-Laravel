@extends('layouts.app')

@section('content')
<section class="py-20 bg-app-bg text-center">
    <h1 class="text-2xl font-semibold text-white mb-6">
        Complete Payment
    </h1>

    <button
        id="pay-button"
        class="px-6 py-3 rounded-xl bg-indigo-500 text-white hover:bg-indigo-600">
        Pay with Midtrans
    </button>

    {{-- DEBUG (hapus nanti) --}}
    <p class="mt-4 text-sm text-red-400">
        Token: {{ $order->payment_token ?? 'NULL' }}
    </p>
</section>

{{-- MIDTRANS SNAP --}}
<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
document.getElementById('pay-button').addEventListener('click', function () {

    const token = @json($order->payment_token);

    console.log('MIDTRANS TOKEN:', token);

    // 🔴 GUARD 1: token kosong
    if (!token) {
        alert('Payment token is missing. Checkout belum memanggil Midtrans.');
        return;
    }

    // 🔴 GUARD 2: snap.js tidak terload
    if (typeof snap === 'undefined') {
        alert('Midtrans Snap gagal dimuat.');
        return;
    }

    // ✅ SNAP PAY
    snap.pay(token, {
        onSuccess: function (result) {
            console.log('SUCCESS', result);
            window.location.href = "{{ route('orders.index') }}";
        },
        onPending: function (result) {
            console.log('PENDING', result);
            window.location.href = "{{ route('orders.index') }}";
        },
        onError: function (result) {
            console.error('ERROR', result);
            alert('Payment failed');
        }
    });
});
</script>
@endsection
