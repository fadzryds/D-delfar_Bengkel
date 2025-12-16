@extends('layouts.app')

@section('title', 'Sparepart - D\'Delfar Bengkel Motor')

@section('content')

<link rel="stylesheet" href="{{ asset('css/description.css') }}">

<div class="detail-container">

    <a href="{{ route('sparepart') }}" class="back-btn">←</a>

    <div class="detail-card">

        <div class="detail-left">
            <img 
                src="{{ $sparepart->image 
                    ? asset('storage/' . $sparepart->image) 
                    : asset('images/default-sparepart.jpeg') }}" 
                class="detail-img"
                alt="{{ $sparepart->name }}"
            >
        </div>

        <div class="detail-right">
            <h2>{{ $sparepart->name }}</h2>

            <p class="price">
                Rp {{ number_format($sparepart->price, 0, ',', '.') }}
            </p>

            <p class="stock 
                {{ $sparepart->stock > 0 ? 'stock-available' : 'stock-empty' }}">
                @if ($sparepart->stock > 0)
                    Stok tersedia: {{ $sparepart->stock }}
                @else
                    Stok habis
                @endif
            </p>

            <div class="qty-box">
                <button class="qty-btn" {{ $sparepart->stock == 0 ? 'disabled' : '' }}>-</button>
                <span>1</span>
                <button class="qty-btn" {{ $sparepart->stock == 0 ? 'disabled' : '' }}>+</button>
            </div>

            <button 
                class="cart-btn {{ $sparepart->stock == 0 ? 'disabled' : '' }}"
            >
                🛒 Keranjang
            </button>
        </div>

    </div>

    <div class="description-box">
        <h3>Deskripsi</h3>
        <p>{{ $sparepart->description ?? 'Deskripsi tidak tersedia' }}</p>
    </div>

    <h2 class="other-title">Sparepart Lainnya</h2>

    <div class="other-grid">
        @foreach($otherSpareparts as $item)
            <div class="other-card">
                <img 
                    src="{{ $item->image 
                        ? asset('storage/' . $item->image) 
                        : asset('images/default-sparepart.jpeg') }}"
                    alt="{{ $item->name }}"
                >

                <h4>{{ $item->name }}</h4>

                <p class="price-small">
                    Rp {{ number_format($item->price, 0, ',', '.') }}
                </p>

                <p class="stock-small 
                    {{ $item->stock > 0 ? 'stock-available' : 'stock-empty' }}">
                    {{ $item->stock > 0 ? 'Stok: '.$item->stock : 'Habis' }}
                </p>

                <a 
                    href="{{ route('sparepart.show', $item->id) }}" 
                    class="btn-other {{ $item->stock == 0 ? 'disabled' : '' }}"
                >
                    🛒 Keranjang
                </a>
            </div>
        @endforeach
    </div>

</div>

@endsection
