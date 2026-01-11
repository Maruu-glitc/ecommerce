{{-- ================================================
FILE: resources/views/orders/show.blade.php
FUNGSI: Detail Order & Pembayaran (Foodmart Style)
================================================ --}}

@extends('layouts.distro')

@section('content')

<style>
    :root {
        --fm-primary: #FACE68;
        --fm-primary-dark: #dabe7d;
        --fm-radius: 12px;
    }

    .order-card {
        border: none;
        border-radius: var(--fm-radius);
        overflow: hidden;
        background: #fff;
    }

    .bg-foodmart-gradient {
        background: linear-gradient(135deg, #FACE68, #ceba8a);
    }

    /* Tabel Styling */
    .table thead th {
        background-color: #f8f9fa;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        color: #6c757d;
        border-bottom: 2px solid #eee;
    }

    .product-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px; /* Kotak radius sedikit */
    }

    /* Badge Custom */
    .badge-boxy {
        border-radius: 6px !important;
        padding: 6px 12px;
        font-weight: 600;
    }

    /* Tombol Boxy */
    .btn-pay {
        background-color: var(--fm-primary);
        color: white;
        border: none;
        border-radius: 8px !important; /* Kotak radius sedikit */
        font-weight: 700;
        padding: 15px 30px;
        transition: all 0.3s ease;
    }

    .btn-pay:hover {
        background-color: var(--fm-primary-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(159, 202, 214, 0.4);
    }

    .info-label {
        font-size: 0.8rem;
        color: #adb5bd;
        text-transform: uppercase;
        font-weight: 700;
        display: block;
        margin-bottom: 4px;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="order-card shadow-sm">
                
                {{-- Header: Info Utama (Grid) --}}
                <div class="p-4 bg-foodmart-gradient text-white">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <span class="opacity-75 small">Nomor Pesanan</span>
                            <h1 class="h3 fw-bold mb-0">#{{ $order->order_number }}</h1>
                            <p class="small mb-0 opacity-75">
                                <i class="bi bi-calendar3 me-1"></i> {{ $order->created_at->format('d F Y, H:i') }}
                            </p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="info-label text-white-50">Status Pesanan</span>
                            <span class="badge badge-boxy fs-6
                                @switch($order->status)
                                    @case('pending') bg-warning text-dark @break
                                    @case('processing') bg-light text-primary @break
                                    @case('delivered') bg-success text-white @break
                                    @case('cancelled') bg-danger text-white @break
                                    @default bg-light text-dark
                                @endswitch
                            ">
                                {{ strtoupper($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Body: Detail Produk (Grid Tabel) --}}
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Item Pesanan</h5>
                    <div class="table-responsive">
                        <table class="table align-middle border-0">
                            <thead>
                                <tr>
                                    <th colspan="2">Produk</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Harga Satuan</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td style="width: 80px;">
                                        <img src="{{ $item->product->image_url ?? asset('images/default-product.png') }}" 
                                             class="product-img border" alt="product">
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $item->product_name }}</div>
                                        @if($item->discount_price)
                                            <span class="badge bg-danger-subtle text-danger x-small" style="font-size: 0.7rem;">Promo</span>
                                        @endif
                                    </td>
                                    <td class="text-center fw-semibold text-muted">{{ $item->quantity }}</td>
                                    <td class="text-end text-muted">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end fw-bold">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Summary Total (Grid 2 Kolom) --}}
                    <div class="row justify-content-end mt-4">
                        <div class="col-md-6">
                            <div class="bg-light p-4 rounded-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Ongkos Kirim</span>
                                    <span class="fw-bold">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark">Total Pembayaran</span>
                                    <span class="h4 fw-bold text-primary mb-0">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer: Alamat & Aksi --}}
                <div class="card-footer bg-white p-4 border-top">
                    <div class="row g-4 align-items-center">
                        {{-- Info Pengiriman --}}
                        <div class="col-md-7">
                            <div class="d-flex gap-3">
                                <div class="text-primary fs-4">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div>
                                    <span class="info-label">Alamat Pengiriman</span>
                                    <h6 class="fw-bold mb-1">{{ $order->shipping_name }}</h6>
                                    <p class="text-muted small mb-0">
                                        {{ $order->shipping_phone }}<br>
                                        {{ $order->shipping_address }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Bayar (Grid Aksi) --}}
                        <div class="col-md-5 text-md-end">
                            @if($order->status === 'pending' && $order->snap_token)
                                <button id="pay-button" class="btn btn-pay w-100 w-md-auto">
                                    <i class="bi bi-credit-card-2-front me-2"></i>BAYAR SEKARANG
                                </button>
                            @else
                                <div class="p-3 border rounded text-center bg-light">
                                    <small class="text-muted d-block">Metode Pembayaran</small>
                                    <span class="fw-bold text-dark">Lunas / Dalam Proses</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center mt-4">
                <a href="{{ route('orders.index') }}" class="text-decoration-none text-muted small fw-bold">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pesanan
                </a>
            </div>

        </div>
    </div>
</div>

@if($order->snap_token)
@push('scripts')
<script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const payButton = document.getElementById('pay-button');
        if (payButton) {
            payButton.addEventListener('click', function () {
                payButton.disabled = true;
                payButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menghubungkan...';

                snap.pay('{{ $order->snap_token }}', {
                    onSuccess: () => window.location.href = '{{ route("orders.success", $order) }}',
                    onPending: () => window.location.href = '{{ route("orders.pending", $order) }}',
                    onError: () => location.reload(),
                    onClose: () => {
                        payButton.disabled = false;
                        payButton.innerHTML = '<i class="bi bi-credit-card-2-front me-2"></i>BAYAR SEKARANG';
                    }
                });
            });
        }
    });
</script>
@endpush
@endif

@endsection