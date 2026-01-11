{{-- ================================================
FILE: resources/views/cart/index.blade.php
FUNGSI: Halaman keranjang belanja (Modern Foodmart Style)
================================================ --}}
<style>
    /* Modern Foodmart Variables */
    :root {
        --fm-primary: #FACE68;
        --fm-primary-dark: #d4af57;
        --fm-radius: 12px;
    }

    .fm-card {
        border-radius: var(--fm-radius) !important;
        overflow: hidden;
    }

    /* Image Container */
    .fm-img-container {
        width: 80px;
        height: 80px;
        background: #f8f9fa;
        border-radius: 8px;
        padding: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #eee;
    }

    .fm-img-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    /* Table Styling */
    .fm-table thead th {
        background-color: #fcfcfc;
        border-bottom: 2px solid #f1f1f1;
        color: #888;
        padding: 1rem;
    }

    .fm-table tbody td {
        border-bottom: 1px solid #f1f1f1;
    }

    /* Input Quantity */
    .quantity-grid-sm {
        width: 100px;
    }

    .quantity-grid-sm input {
        border-radius: 6px 0 0 6px !important;
        font-size: 0.9rem;
        padding: 0.4rem;
    }

    .quantity-grid-sm .input-group-text {
        border-radius: 0 6px 6px 0 !important;
    }

    /* Custom Buttons (Modern Boxy Style) */
    .btn-foodmart {
        background-color: var(--fm-primary);
        border-color: var(--fm-primary);
        color: #fff;
        border-radius: 8px !important;
        transition: all 0.3s ease;
    }

    .btn-foodmart:hover {
        background-color: var(--fm-primary-dark);
        border-color: var(--fm-primary-dark);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(159, 202, 214, 0.3);
    }

    .btn-outline-secondary {
        border-radius: 8px !important;
    }

    .tracking-wider {
        letter-spacing: 0.05em;
    }
</style>
@extends('layouts.distro')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="container py-5">
        {{-- Header --}}
        <div class="d-flex align-items-center mb-4 gap-3">
            <div class="bg-primary-subtle p-3 rounded-3">
                <i class="bi bi-cart3 fs-3 text-primary"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-0">Keranjang Belanja</h2>
                <p class="text-muted mb-0">Kelola item pilihanmu sebelum checkout</p>
            </div>
        </div>

        @if ($cart && $cart->items->count())
            <div class="row g-4">
                {{-- Item List (Grid System) --}}
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm fm-card">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 fw-bold">Daftar Item ({{ $cart->items->count() }})</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 fm-table">
                                    <thead class="table-light">
                                        <tr class="text-uppercase small fw-bold tracking-wider">
                                            <th class="ps-4">Produk</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-end pe-4">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart->items as $item)
                                            <tr>
                                                <td class="ps-4 py-4">
                                                    <div class="d-flex align-items-center">
                                                        {{-- Product Image Container --}}
                                                        <div class="fm-img-container me-3">
                                                            <img src="{{ $item->product->image_url }}"
                                                                alt="{{ $item->product->name }}">
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('catalog.show', $item->product->slug) }}"
                                                                class="text-decoration-none fw-bold text-dark d-block mb-1">
                                                                {{ Str::limit($item->product->name, 40) }}
                                                            </a>
                                                            <span class="badge bg-light text-muted border fw-normal mb-2">
                                                                {{ $item->product->category->name }}
                                                            </span>
                                                            <div class="text-primary fw-bold">
                                                                {{ $item->product->formatted_price }}</div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    {{-- Jumlah --}}
                                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                        class="d-inline-block">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="input-group quantity-grid-sm mx-auto">
                                                            <input type="number" name="quantity"
                                                                value="{{ $item->quantity }}" min="1"
                                                                max="{{ $item->product->stock }}"
                                                                class="form-control text-center fw-bold border-end-0"
                                                                onchange="this.form.submit()">
                                                            <span
                                                                class="input-group-text bg-white border-start-0 small text-muted">pcs</span>
                                                        </div>
                                                    </form>

                                                    {{-- Hapus produk --}}
                                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                                                        class="mt-2 d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-link btn-sm text-decoration-none p-0 btn-delete"
                                                            style="color: red">
                                                            <i class="bi bi-trash3 me-1"></i>Hapus
                                                        </button>
                                                    </form>
                                                </td>

                                                <td class="text-end pe-4 fw-bold text-dark fs-5">
                                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Summary Sidebar --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm fm-card sticky-top" style="top: 2rem;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Ringkasan Belanja</h5>

                            <div class="summary-details mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Total Item</span>
                                    <span class="fw-bold">{{ $cart->items->sum('quantity') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">Total Harga</span>
                                    <span class="fw-bold">Rp
                                        {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}</span>
                                </div>
                                <hr class="border-secondary-subtle">
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold text-dark fs-5">Total Bayar</span>
                                    <span class="fw-bold text-primary fs-4">
                                        Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            {{-- Button Grid --}}
                            <div class="row g-2">
                                <div class="col-12">
                                    <a href="{{ route('checkout.index') }}"
                                        class="btn btn-foodmart w-100 py-3 fw-bold text-uppercase">
                                        <i class="bi bi-shield-check me-2"></i>Lanjut Checkout
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('catalog.index') }}"
                                        class="btn btn-outline-secondary w-100 py-2 fw-semibold">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali Belanja
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5 bg-white shadow-sm rounded-4 fm-card mt-4">
                <div class="display-1 text-muted mb-4">
                    <i class="bi bi-cart-x"></i>
                </div>
                <h3 class="fw-bold">Wah, Keranjangmu Kosong!</h3>
                <p class="text-muted mb-4">Yuk, cari produk favoritmu di katalog kami sekarang.</p>
                <a href="{{ route('catalog.index') }}" class="btn btn-foodmart px-5 py-3 fw-bold">
                    Eksplor Katalog
                </a>
            </div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('form'); // Mengambil form terdekat

                Swal.fire({
                    title: 'Hapus item ini?',
                    text: "Item akan dihapus dari keranjang belanja Anda.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#FFC400', // Warna Kuning yang Anda minta
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim form jika user klik 'Ya'
                    }
                });
            });
        });
    </script>

@endsection
