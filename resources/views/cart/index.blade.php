{{-- ================================================
FILE: resources/views/cart/index.blade.php
FUNGSI: Halaman keranjang belanja
================================================ --}}

@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

<style>
    body{
        background-color: #F6F5F5;
    }
    :root {
        --brand: #8CA9FF;
        --brand-soft: rgba(140, 169, 255, .15);
    }

    .bg-brand {
        background-color: var(--brand);
    }

    .bg-brand-soft {
        background: linear-gradient(135deg, #ffffff, #ffffff);
    }

    .text-brand {
        color: var(--brand);
    }

    .btn-brand {
        background-color: var(--brand);
        border-color: var(--brand);
        color: #fff;
    }

    .btn-brand:hover {
        background-color: #7896f0;
        border-color: #7896f0;
        color: #fff;
    }

    .table thead th {
        font-weight: 500;
        color: #6c757d;
    }
</style>

<div class="container py-4">
    <h2 class="mb-4 fw-semibold">
        <i class="bi bi-cart3 me-2 text-brand"></i>Keranjang Belanja
    </h2>

    @if($cart && $cart->items->count())
    <div class="row">
        {{-- Cart Items --}}
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">

                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->product->image_url }}" class="rounded-3 me-3" width="64"
                                            height="64" style="object-fit: cover">

                                        <div>
                                            <a href="{{ route('catalog.show', $item->product->slug) }}"
                                                class="text-decoration-none fw-medium text-dark">
                                                {{ Str::limit($item->product->name, 42) }}
                                            </a>
                                            <div class="small text-muted">
                                                {{ $item->product->category->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    {{ $item->product->formatted_price }}
                                </td>

                                <td class="text-center">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                        class="d-inline-flex align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                            max="{{ $item->product->stock }}"
                                            class="form-control form-control-sm text-center" style="width: 70px"
                                            onchange="this.form.submit()">
                                    </form>
                                </td>

                                <td class="text-end fw-semibold">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>

                                <td class="text-end">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border"
                                            onclick="return confirm('Hapus item ini?')">
                                            <i class="bi bi-x-lg text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        {{-- Summary --}}
        <div class="col-lg-4 rounded-2">
            <div class="card sticky-top" style="top: 90px; box-shadow: 0 0 9px rgba(0, 0, 0, .1); ">
                <div class="p-4 bg-brand-soft">
                    <h5 class="fw-semibold mb-3">Ringkasan Belanja</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">
                            Total ({{ $cart->items->sum('quantity') }} item)
                        </span>
                        <span>
                            Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                        </span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-semibold">Total Bayar</span>
                        <span class="fw-bold fs-5 text-brand">
                            Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                        </span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn btn-brand w-100 btn-lg mb-2">
                        <i class="bi bi-credit-card me-2"></i>Checkout
                    </a>

                    <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-left me-2"></i>Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>

    @else
    {{-- Empty Cart --}}
    <div class="text-center py-5">
        <i class="bi bi-cart-x display-1 text-muted"></i>
        <h4 class="mt-3 fw-semibold">Keranjang Kosong</h4>
        <p class="text-muted">Belum ada produk di keranjang belanja kamu</p>
        <a href="{{ route('catalog.index') }}" class="btn btn-brand px-4">
            <i class="bi bi-bag me-2"></i>Mulai Belanja
        </a>
    </div>
    @endif
</div>

@endsection