@extends('layouts.app')

@section('title', 'Checkout Sparepart - D\'Delfar Bengkel Motor')

@section('content')

<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

<div class="checkout-wrapper">

    <h2>Checkout Sparepart</h2>

    <form action="{{ route('checkout.sparepart.store') }}" method="POST">
        @csrf

        @forelse($cart as $key => $item)
        <div class="checkout-card">
            <label class="checkbox-box">
                <input type="checkbox" name="items[{{ $key }}][checked]" value="1">
                <span></span>
            </label>

            <img src="{{ asset('storage/'.$item['image']) }}" class="item-img">

            <div class="item-info">
                <h4>{{ $item['name'] }}</h4>
                <p>Harga: Rp {{ number_format($item['price'],0,',','.') }}</p>
                <p>Qty: {{ $item['quantity'] }}</p>
                <p class="total">
                    Total: Rp {{ number_format($item['price'] * $item['quantity'],0,',','.') }}
                </p>
            </div>

            {{-- data tersembunyi --}}
            <input type="hidden" name="items[{{ $key }}][sparepart_id]" value="{{ $item['id'] }}">
            <input type="hidden" name="items[{{ $key }}][quantity]" value="{{ $item['quantity'] }}">
            <input type="hidden" name="items[{{ $key }}][price]" value="{{ $item['price'] }}">
            <input type="hidden" name="items[{{ $key }}][nama_pelanggan]" value="{{ auth()->user()->name }}">
            <input type="hidden" name="items[{{ $key }}][no_hp]" value="{{ auth()->user()->customer->no_hp ?? '-' }}">
        </div>
        @empty
        <p class="empty-cart">Keranjang masih kosong</p>
        @endforelse

        <div class="checkout-action">
            <a href="{{ route('checkout.sparepart.confirm') }}" class="btn-checkout">
            Checkout Sekarang
        </a>
        </div>

    </form>
</div>

@endsection
