{{-- ================================================
FILE: resources/views/orders/index.blade.php
FUNGSI: Riwayat Pesanan (Modern Foodmart Style)
================================================ --}}

@extends('layouts.distro')

@section('content')

<style>
    :root {
        --fm-primary: #FACE68;
        --fm-primary-dark: #e9c166;
        --fm-radius: 12px;
    }

    .order-item-card {
        border: 1px solid #eee;
        border-radius: var(--fm-radius);
        transition: all 0.3s ease;
        background: #fff;
        overflow: hidden;
    }

    .order-item-card:hover {
        border-color: var(--fm-primary);
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }

    /* Thumbnail Presisi */
    .order-img-wrapper {
        width: 100px;
        height: 100px;
        flex-shrink: 0;
    }

    .order-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px; /* Kotak dengan sedikit radius */
    }

    /* Badge Boxy */
    .badge-boxy {
        border-radius: 6px !important;
        padding: 5px 12px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
    }

    /* Tombol Aksi Kotak */
    .btn-fm-outline {
        border: 2px solid var(--fm-primary);
        color: var(--fm-primary);
        font-weight: 700;
        border-radius: 8px !important;
        transition: 0.2s;
        font-size: 0.85rem;
    }

    .btn-fm-outline:hover {
        background-color: var(--fm-primary);
        color: #fff;
    }

    .order-number {
        font-size: 0.9rem;
        color: #adb5bd;
    }

    .price-tag {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2D3436;
    }
</style>

<div class="container py-5">
    <div class="d-flex align-items-center mb-4 justify-content-between">
        <div>
            <h1 class="h3 fw-bold mb-1">Pesanan Saya</h1>
            <p class="text-muted small mb-0">Pantau status pengiriman dan riwayat belanja kamu.</p>
        </div>
        <a href="/" class="btn btn-light btn-sm fw-bold border">
            <i class="bi bi-house-door me-1"></i> Beranda
        </a>
    </div>

    <div class="row g-4">
        @forelse($orders as $order)
        <div class="col-12">
            <div class="order-item-card p-3 p-md-4">
                <div class="row align-items-center g-3">
                    
                    {{-- Grid 1: Gambar --}}
                    <div class="col-auto">
                        <div class="order-img-wrapper border">
                            <img src="{{ $order->image_url ?? asset('images/default-product.png') }}" alt="Order image">
                        </div>
                    </div>

                    {{-- Grid 2: Nama & Info --}}
                    <div class="col">
                        <div class="d-flex flex-column h-100">
                            <span class="order-number fw-medium mb-1">ID PESANAN: #{{ $order->order_number }}</span>
                            <h5 class="fw-bold mb-2 text-dark">
                                {{ $order->items->first()->product_name ?? 'Pesanan Foodmart' }}
                                @if($order->items_count > 1)
                                    <span class="text-muted small fw-normal">(+{{ $order->items_count - 1 }} produk lainnya)</span>
                                @endif
                            </h5>
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                {{-- Status Bayar --}}
                                <span class="badge badge-boxy 
                                    @if($order->payment_status === 'paid') bg-success-subtle text-success 
                                    @elseif($order->payment_status === 'unpaid') bg-danger text-dark 
                                    @endif" >
                                    <i class="bi bi-wallet2 me-1"></i> {{ $order->payment_status }}
                                </span>
                                {{-- Status Pesanan --}}
                                <span class="badge badge-boxy 
                                    @if($order->status === 'delivered') bg-info-subtle text-info 
                                    @elseif($order->status === 'cancelled') bg-danger-subtle text-danger
                                    @else bg-primary-subtle text-primary @endif">
                                    <i class="bi bi-box-seam me-1"></i> {{ $order->status }}
                                </span>
                            </div>
                            <span class="text-muted small">Dipesan pada {{ $order->created_at->format('d M Y') }}</span>
                        </div>
                    </div>

                    {{-- Grid 3: Harga & Tombol --}}
                    <div class="col-lg-3 border-start-lg">
                        <div class="ps-lg-4 text-lg-end">
                            <p class="text-muted small mb-1">Total Belanja</p>
                            <div class="price-tag mb-3">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-fm-outline py-2">
                                    LIHAT DETAIL <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                                @if($order->status === 'pending' && $order->payment_status === 'pending')
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-danger btn-sm border-0 fw-bold py-2" style="border-radius: 8px; color: orange;">
                                    BAYAR SEKARANG
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="mb-3">
                <i class="bi bi-bag-x text-muted opacity-25" style="font-size: 5rem;"></i>
            </div>
            <h4 class="fw-bold">Belum ada pesanan</h4>
            <p class="text-muted">Kamu belum melakukan transaksi apapun di toko kami.</p>
            <a href="/" class="btn btn-foodmart mt-2" style="background-color: var(--fm-primary); color: white; border-radius: 8px; padding: 10px 25px; font-weight: 600;">
                Mulai Belanja
            </a>
        </div>
        @endforelse
    </div>

    {{-- Pagination Grid --}}
    <div class="mt-5 d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
</div>

@endsection