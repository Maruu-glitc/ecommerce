{{-- ================================================
FILE: resources/views/catalog/show.blade.php
FUNGSI: Halaman detail produk (Refined Foodmart Style)
================================================ --}}

@extends('layouts.distro')

@section('title', $product->name)

@section('content')
    <div class="container py-5">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb small p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}"
                        class="text-decoration-none text-muted">Katalog</a></li>
                <li class="breadcrumb-item active fw-bold text-primary">{{ $product->category->name }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            {{-- ================= IMAGE SECTION ================= --}}
            <div class="col-lg-7">
                <div class="card border-0 bg-white overflow-hidden main-product-card">
                    <div class="image-display-container">
                        <img src="{{ $product->image_url }}" id="main-image" class="img-fluid" alt="{{ $product->name }}">

                        @if ($product->has_discount)
                            <div class="discount-label">-{{ $product->discount_percentage }}%</div>
                        @endif
                    </div>

                    @if ($product->images->count() > 1)
                        <div class="p-3 bg-white border-top">
                            <div class="d-flex gap-2 overflow-auto thumb-gallery">
                                @foreach ($product->images as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail thumb-item"
                                        onclick="document.getElementById('main-image').src = this.src" alt="Thumbnail">
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ================= INFO SECTION ================= --}}
            <div class="col-lg-5">
                <div class="product-info-wrapper h-100">
                    {{-- Header Info --}}
                    <div class="mb-4">
                        <span class="text-uppercase tracking-wider text-muted small fw-bold mb-2 d-block">
                            {{ $product->category->name }}
                        </span>
                        <h1 class="display-6 fw-bold mb-2 text-dark">{{ $product->name }}</h1>

                        <div class="d-flex align-items-baseline gap-2 mt-3">
                            <h2 class="fw-bold text-primary mb-0">{{ $product->formatted_price }}</h2>
                            @if ($product->has_discount)
                                <span class="text-muted text-decoration-line-through fs-5">
                                    {{ $product->formatted_original_price }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-muted lh-base">{!! $product->description !!}</p>
                        <div class="small text-muted border-top border-bottom py-2">
                            <div class="row">
                                <div class="col-6"><strong>SKU:</strong> PROD-{{ $product->id }}</div>
                                <div class="col-6 text-end"><strong>Berat:</strong> {{ $product->weight }}g</div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Area --}}
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        {{-- Quantity Selector --}}
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase">Jumlah Pesanan</label>
                            <div class="input-group quantity-grid" style="width: 160px;">
                                <button class="btn btn-outline-secondary btn-qty" type="button"
                                    onclick="decrementQty()">-</button>
                                <input type="number" name="quantity" id="quantity"
                                    class="form-control text-center fw-bold" value="1" min="1"
                                    max="{{ $product->stock }}">
                                <button class="btn btn-outline-secondary btn-qty" type="button"
                                    onclick="incrementQty()">+</button>
                            </div>
                            <small class="text-{{ $product->stock > 0 ? 'success' : 'danger' }} mt-2 d-block fw-semibold">
                                Stock: {{ $product->stock }} {{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}
                            </small>
                        </div>

                        {{-- Grid Tombol Aksi --}}
                        <div class="row g-2">
                            <div class="col-12">
                                <button type="submit" class="btn btn-foodmart w-100 py-3 fw-bold text-uppercase"
                                    @if ($product->stock == 0) disabled @endif>
                                    <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                                </button>
                            </div>
                            {{-- <div class="col-8">
                            <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100 py-3 fw-bold text-uppercase">
                                <i class="bi bi-bag-check me-2"></i> Beli Sekarang
                            </a>
                        </div> --}}
                            <div class="col-4 ">
                                @auth
                                    <button type="button" onclick="toggleWishlist({{ $product->id }})"
                                        class="btn btn-outline-danger mb-4 wishlist-btn-{{ $product->id }}">
                                        <i
                                            class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill' : 'bi-heart' }} me-2"></i>
                                        {{ auth()->user()->hasInWishlist($product) ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}
                                    </button>
                                @endauth
                            </div>
                        </div>
                    </form>

                    {{-- Trust Badges --}}
                    <div class="mt-5 d-flex gap-4 p-3 bg-light rounded-3">
                        <div class="text-center small">
                            <i class="bi bi-shield-check fs-4 d-block text-primary"></i>
                            <span>Original</span>
                        </div>
                        <div class="text-center small">
                            <i class="bi bi-truck fs-4 d-block text-primary"></i>
                            <span>Pengiriman Cepat</span>
                        </div>
                        <div class="text-center small">
                            <i class="bi bi-arrow-repeat fs-4 d-block text-primary"></i>
                            <span>Easy Return</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="wishlistToast" class="toast align-items-center text-bg-dark border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body" id="wishlistToastMessage">
                    Wishlist updated
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>


    <style>
        /* Reset & Foodmart Theme */
        :root {
            --fm-primary: #f0cc69;
            --fm-dark: #2D3436;
            --fm-border-radius: 8px;
            /* Square with slight radius */
        }

        /* .bi{
                    transition: all 0.3s ease;
                }

                .bi:hover {
                    cursor: pointer;
                    color: red;

                }

                .bi:hover::before {
                    content: "\f415";
                    /* bi-heart-fill */
        /* } */

        .main-product-card {
            border-radius: var(--fm-border-radius);
            border: 1px solid #eee !important;
        }

        /* Image Container: Memastikan gambar pas di card */
        .image-display-container {
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            padding: 2rem;
            position: relative;
        }

        .image-display-container img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            /* Gambar tidak terpotong */
        }

        .discount-label {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #ff4757;
            color: white;
            padding: 5px 15px;
            font-weight: bold;
            border-radius: 4px;
        }

        .wishlist-btn i {
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .wishlist-btn:hover i {
            transform: scale(1.2);
            color: red;
        }

        /* Gallery Thumbnails */
        .thumb-item {
            width: 70px;
            height: 70px;
            object-fit: cover;
            cursor: pointer;
            border-radius: 4px;
            border: 2px solid transparent;
        }

        .thumb-item:hover {
            border-color: var(--fm-primary);
        }

        /* Tombol / Button Styles */
        .btn {
            border-radius: var(--fm-border-radius) !important;
            transition: all 0.2s ease;
            border-width: 2px;
        }

        .btn-foodmart {
            background-color: var(--fm-primary);
            border-color: var(--fm-primary);
            color: #fff;
        }

        .btn-foodmart:hover {
            background-color: #8bb7c2;
            border-color: #8bb7c2;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-qty {
            border-color: #dee2e6;
            background: #f8f9fa;
        }

        /* Typography */
        .tracking-wider {
            letter-spacing: 0.1em;
        }

        /* Custom Input Number */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    @push('scripts')
        <script>
            function incrementQty() {
                const input = document.getElementById('quantity');
                const max = parseInt(input.max);
                if (parseInt(input.value) < max) {
                    input.value = parseInt(input.value) + 1;
                }
            }

            function decrementQty() {
                const input = document.getElementById('quantity');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            }

            function toggleWishlist(productId) {
                fetch(`/wishlist/toggle/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        const btn = document.querySelector('.wishlist-btn-' + productId);
                        const icon = btn.querySelector('i');
                        const toastEl = document.getElementById('wishlistToast');
                        const toastMsg = document.getElementById('wishlistToastMessage');

                        if (data.status === 'added') {
                            icon.classList.remove('bi-heart');
                            icon.classList.add('bi-heart-fill');
                            toastMsg.innerText = '❤️ Ditambahkan ke Wishlist';
                        } else {
                            icon.classList.remove('bi-heart-fill');
                            icon.classList.add('bi-heart');
                            toastMsg.innerText = '💔 Dihapus dari Wishlist';
                        }

                        const toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    });
            }
        </script>
    @endpush

@endsection
