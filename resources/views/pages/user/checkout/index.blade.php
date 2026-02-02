@extends('layouts.app')

@section('title','Checkout')

@section('content')
<section class="py-16 bg-app-bg">
    <div class="max-w-4xl mx-auto px-6">
        <h1 class="text-2xl font-semibold text-white mb-6">Checkout</h1>

        @foreach ($carts as $cart)
            <div class="flex justify-between mb-3 text-app-muted">
                <span>{{ $cart->product->name }} × {{ $cart->qty }}</span>
                <span>Rp {{ number_format($cart->product->price * $cart->qty) }}</span>
            </div>
        @endforeach

        <div class="mt-6 flex justify-between font-semibold text-white">
            <span>Total</span>
            <span>Rp {{ number_format($total) }}</span>
        </div>

        <form method="POST" action="{{ route('checkout.process') }}" class="mt-8">
            @csrf
            <button class="w-full py-3 rounded-xl bg-indigo-500 text-white hover:bg-indigo-600">
                Pay with Midtrans
            </button>
        </form>
    </div>
</section>
@endsection
