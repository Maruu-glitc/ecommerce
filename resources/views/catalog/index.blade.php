@extends('layouts.distro')

@section('title', 'Katalog Produk')

@section('content')

    {{-- ================= FOODMART STYLE CSS ================= --}}
    <style>
        /* ===== PAGE ===== */
        .catalog-page {
            background-color: #f8f9fa;
        }

        /* ===== SCROLL ANIMATION ===== */
        .fade-up {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .6s ease, transform .6s ease;
        }

        .fade-up.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== FILTER SIDEBAR ===== */
        .filter-card {
            background: #fff;
            border-radius: 8px;
            padding: 1.25rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .05);
        }

        .filter-card h6 {
            font-weight: 600;
        }

        /* ===== HEADER ===== */
        .catalog-header {
            background: #fff;
            padding: 1rem 1.25rem;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .04);
            margin-bottom: 1.25rem;
        }

        .catalog-sort {
            min-width: 160px;
            border-radius: .30rem;
        }

        /* ===== PRODUCT CARD ===== */
        .product-card {
            background: #fff;
            border-radius: 7px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .05);
            transition: .3s ease;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, .08);
        }

        .product-img {
            position: relative;
            aspect-ratio: 1 / 1;
            background: #f1f3f5;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-discount {
            position: absolute;
            top: .75rem;
            left: .75rem;
            background: #dc3545;
            color: #fff;
            font-size: .75rem;
            padding: .25rem .5rem;
            border-radius: .5rem;
        }

        .product-body {
            padding: .75rem .9rem 1rem;
        }

        .product-title {
            font-size: .9rem;
            font-weight: 600;
            margin-bottom: .25rem;
        }

        .product-price {
            font-size: .9rem;
        }

        /* ===== PAGINATION ===== */
        .pagination {
            gap: .4rem;
        }

        .pagination .page-link {
            border-radius: .75rem !important;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .05);
        }

        .pagination svg {
            width: 16px;
            height: 16px;
        }
    </style>

    <div class="container py-5 catalog-page">
        <div class="row g-4">

            {{-- ================= FILTER SIDEBAR ================= --}}
            <aside class="col-lg-3 d-none d-lg-block fade-up">
                <div class="filter-card">
                    <h6 class="mb-3">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </h6>

                    <form action="{{ route('catalog.index') }}" method="GET">
                        @if (request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif

                        {{-- Category --}}
                        <div class="mb-4">
                            <small class="fw-semibold text-muted">Kategori</small>
                            @foreach ($categories as $category)
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="category"
                                        value="{{ $category->slug }}"
                                        {{ request('category') == $category->slug ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                    <label class="form-check-label">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        {{-- Price --}}
                        <div class="mb-3">
                            <small class="fw-semibold text-muted">Harga</small>
                            <div class="d-flex gap-2 mt-2">
                                <input type="number" class="form-control form-control-sm" name="min_price"
                                    placeholder="Min" value="{{ request('min_price') }}">
                                <input type="number" class="form-control form-control-sm" name="max_price"
                                    placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                            <button class="btn btn-sm btn-dark w-100 mt-2">
                                Terapkan
                            </button>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="on_sale" value="1"
                                {{ request('on_sale') ? 'checked' : '' }} onchange="this.form.submit()">
                            <label class="form-check-label">
                                Diskon
                            </label>
                        </div>
                    </form>
                </div>
            </aside>

            {{-- ================= PRODUCT LIST ================= --}}
            <main class="col-lg-9">

                {{-- Header --}}
                <div class="catalog-header fade-up">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-1">
                                @if (request('q'))
                                    "{{ request('q') }}"
                                @elseif(request('category'))
                                    {{ $categories->firstWhere('slug', request('category'))?->name }}
                                @else
                                    Semua Produk
                                @endif
                            </h4>
                            <small class="text-muted">{{ $products->total() }} produk tersedia</small>
                        </div>

                        <select class="form-select form-select-sm catalog-sort" onchange="location.href=this.value">
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">Terbaru</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}">Harga Termurah
                            </option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}">Harga Termahal
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Grid --}}
                @if ($products->count())
                    <div class="row g-3">
                        @foreach ($products as $i => $product)
                            <div class="col-6 col-md-4 col-lg-3 fade-up" style="transition-delay: {{ $i * 0.06 }}s">

                                {{-- PRODUCT CARD --}}
                                <div class="product-card">
                                    <a href="{{ route('catalog.show', $product->slug) }}">
                                        <div class="product-img">
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">

                                            @if ($product->has_discount)
                                                <span class="badge-discount">-{{ $product->discount_percentage }}%</span>
                                            @endif
                                        </div>
                                    </a>

                                    <div class="product-body">
                                        <h6 class="product-title">{{ $product->name }}</h6>

                                        <div class="product-price">
                                            @if ($product->has_discount)
                                                <span class="text-dark fw-semibold">
                                                    Rp{{ number_format($product->final_price) }}
                                                </span>
                                                <small class="text-muted text-decoration-line-through">
                                                    Rp{{ number_format($product->price) }}
                                                </small>
                                            @else
                                                <span class="fw-semibold">
                                                    Rp{{ number_format($product->price) }}
                                                </span>
                                            @endif
                                        </div>

                                        @if ($product->stock <= 5 && $product->stock > 0)
                                            <small class="bade bg-warning text-dark"><i
                                                    class="bi bi-exclamation-circle"></i> Stok
                                                Tinggal {{ $product->stock }}</small></small>
                                        @elseif ($product->stock == 0)
                                            <small class="bade bg-danger"><i class="bi bi-x-circle"></i> Stok Habis</small>
                                        @else
                                            <small style="border-color: rgb(66, 245, 66); color: rgb(72, 245, 72);"
                                                class="bade fw-bold p-1 rounded-1"><i class="bi bi-check-circle"></i>
                                                Tersedia</small>
                                        @endif



                                        <a href="{{ route('catalog.show', $product->slug) }}"
                                            class="btn btn-sm btn-dark w-100 mt-2">
                                            Lihat Produk
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="d-grid mt-4 fade-up">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-5 text-muted fade-up">
                        <i class="bi bi-search fs-1"></i>
                        <p class="mt-3">Produk tidak ditemukan</p>
                    </div>
                @endif
            </main>
        </div>
    </div>

    {{-- ================= SCROLL OBSERVER ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.12
            });

            document.querySelectorAll('.fade-up')
                .forEach(el => observer.observe(el));
        });
    </script>

@endsection
