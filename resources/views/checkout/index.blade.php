{{-- ================================================
FILE: resources/views/checkout/index.blade.php
FUNGSI: Halaman Checkout (Modern Foodmart Style)
================================================ --}}

@extends('layouts.distro')

@section('content')

<style>
    :root {
        --fm-primary: #FACE68;
        --fm-primary-dark: #FACE68;
        --fm-radius: 12px;
    }

    .checkout-title {
        font-weight: 700;
        color: #2D3436;
    }

    .fm-card {
        border: 0;
        border-radius: var(--fm-radius);
        background-color: #fff;
    }

    /* Input & Form Styling */
    .fm-input-group {
        position: relative;
    }

    .fm-input-group i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--fm-primary);
        z-index: 10;
    }

    .fm-input-group.align-top i {
        top: 15px;
        transform: none;
    }

    .fm-form-control {
        padding-left: 45px !important;
        border-radius: 8px !important;
        border: 1px solid #dee2e6;
        padding: 12px;
        transition: all 0.3s ease;
    }

    .fm-form-control:focus {
        border-color: var(--fm-primary);
        box-shadow: 0 0 0 0.25rem rgba(159, 202, 214, 0.2);
    }

    /* Summary Styling */
    .product-thumb {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #eee;
    }

    /* Button Boxy Modern */
    .btn-foodmart {
        background-color: var(--fm-primary);
        border-color: var(--fm-primary);
        color: #fff;
        border-radius: 8px !important;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-foodmart:hover {
        background-color: var(--fm-primary-dark);
        border-color: var(--fm-primary-dark);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(159, 202, 214, 0.3);
    }
</style>

<div class="container py-5">
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary-subtle p-2 rounded-3">
            <i class="bi bi-shield-check fs-4 p-3 text-primary"></i>
        </div>
        <h1 class="fs-3 checkout-title mb-0">Checkout Pesanan</h1>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="row g-4">

            {{-- Kolom Kiri: Informasi Pengiriman --}}
            <div class="col-lg-8">
                <div class="card fm-card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-geo-alt me-2 text-primary"></i>
                            <h2 class="fs-6 fw-bold mb-0">Informasi Pengiriman</h2>
                        </div>

                        <div class="row g-3">
                            {{-- Nama Penerima --}}
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Nama Penerima</label>
                                <div class="fm-input-group">
                                    <i class="bi bi-person"></i>
                                    <input type="text" name="name" value="{{ auth()->user()->name }}" 
                                           class="form-control fm-form-control" placeholder="Masukkan nama" required>
                                </div>
                            </div>

                            {{-- Nomor Telepon --}}
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Nomor Telepon</label>
                                <div class="fm-input-group">
                                    <i class="bi bi-phone"></i>
                                    <input type="text" name="phone" value="{{ auth()->user()->phone }}" 
                                           class="form-control fm-form-control" placeholder="08xxxxxxxxxx" required>
                                </div>
                            </div>

                            {{-- Alamat Lengkap --}}
                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted">Alamat Lengkap</label>
                                <div class="fm-input-group align-top">
                                    <i class="bi bi-map"></i>
                                    <textarea name="address" rows="4" class="form-control fm-form-control" 
                                              placeholder="Nama jalan, nomor rumah, RT/RW, Kecamatan" required>{{ auth()->user()->address }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Metode Pembayaran (Placeholder) --}}
                <div class="card fm-card shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-wallet2 me-2 text-primary"></i>
                            <h2 class="fs-6 fw-bold mb-0">Metode Pembayaran</h2>
                        </div>
                        <div class="p-3 border rounded-3 bg-light d-flex align-items-center">
                            <i class="bi bi-info-circle me-2"></i>
                            <span class="small">Metode pembayaran akan dipilih di halaman selanjutnya.</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Ringkasan --}}
            <div class="col-lg-4">
                <div class="card fm-card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h2 class="fs-6 fw-bold mb-4">Ringkasan Pesanan</h2>

                        <div class="mb-4" style="max-height: 300px; overflow-y: auto;">
                            @foreach($cart->items as $item)
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $item->product->image_url }}" class="product-thumb me-3">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 small fw-bold">{{ Str::limit($item->product->name, 28) }}</h6>
                                    <span class="text-muted small">{{ $item->quantity }} x {{ $item->product->formatted_price }}</span>
                                </div>
                                <div class="text-end fw-bold small">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="bg-light p-3 rounded-3 mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Subtotal</span>
                                <span class="fw-bold small">Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-0">
                                <span class="text-muted small">Biaya Pengiriman</span>
                                <span class="text-success small fw-bold">Gratis</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Total Bayar</span>
                                <span class="fs-5 fw-bold text-primary">
                                    Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        {{-- Button Grid --}}
                        <div class="row g-2">
                            <div class="col-12">
                                <button type="submit" class="btn btn-foodmart w-100 py-3">
                                    <i class="bi bi-bag-check me-2"></i>Buat Pesanan Sekarang
                                </button>
                            </div>
                            <div class="col-12">
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 py-2 small fw-bold border-0">
                                    Edit Keranjang
                                </a>
                            </div>
                        </div>

                        <div class="mt-4 p-2 bg-primary-subtle rounded-3 text-center">
                            <p class="text-primary x-small mb-0" style="font-size: 0.75rem;">
                                <i class="bi bi-shield-lock-fill me-1"></i> Transaksi Aman & Terenkripsi
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

@endsection