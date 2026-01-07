{{-- ================================================
FILE: resources/views/home.blade.php
FUNGSI: Halaman utama website
================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<style>
    :root {
        --brand: #BDDDE4;
        --brand-dark: #7faab6;
    }

    /* ========= BRAND ========= */
    .bg-brand { background-color: var(--brand); }
    .bg-brand-gradient {
        background: linear-gradient(135deg, #BDDDE4, #eaf4f6);
    }
    .text-brand { color: var(--brand-dark); }

    .btn-brand {
        background-color: var(--brand-dark);
        color: #fff;
        border-radius: 12px;
        padding: .6rem 1.4rem;
        font-weight: 600;
        transition: all .25s ease;
    }
    .btn-brand:hover {
        background-color: #6b98a5;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0,0,0,.15);
    }

    /* ========= CARD ========= */
    .card-soft {
        border: 0;
        border-radius: 16px;
        transition: .25s ease;
    }
    .hover-zoom:hover {
        transform: translateY(-6px) scale(1.02);
        box-shadow: 0 12px 28px rgba(0,0,0,.08);
    }

    /* ========= TITLE ========= */
    h2 {
        background: linear-gradient(135deg, #eaf4f6, #BDDDE4);
        border-radius: 0 20px 20px 0;
        padding: 9px 14px;
        display: inline-block;
    }

    #kat { width: 26%; }
    #lihat:hover { color: #527b86; }

    /* ========= SCROLL ANIMATION ========= */
    .fade-up {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity .6s ease, transform .6s ease;
    }
    .fade-up.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>

{{-- ================= HERO ================= --}}
<section class="bg-brand-gradient py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 fade-up">
                <h1 class="fw-bold display-5 mb-3">
                    Belanja Kaos Simpel,<br>Nyaman & Terpercaya
                </h1>
                <p class="text-muted mb-4 fs-5">
                    Koleksi kaos berkualitas dengan desain modern.
                    Cocok untuk semua gaya.
                </p>
                <a href="{{ route('catalog.index') }}" class="btn btn-brand btn-lg">
                    <i class="bi bi-bag me-2"></i>Mulai Belanja
                </a>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center fade-up">
                <img src="{{ asset('assets/images/kaosPNG.png') }}"
                     class="img-fluid"
                     style="max-height:380px">
            </div>
        </div>
    </div>
</section>

{{-- ================= KATEGORI ================= --}}
<section class="py-5">
    <div class="container">
        <h2 class="section-title mb-4 fade-up" id="kat">Kategori Populer</h2>

        <div class="row g-4 justify-content-center">
            @foreach($categories as $i => $category)
            <div class="col-6 col-md-4 col-lg-2 fade-up"
                 style="transition-delay: {{ $i * 0.08 }}s">
                <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                   class="text-decoration-none text-dark">
                    <div class="card card-soft hover-zoom text-center h-100 shadow-sm">
                        <div class="card-body">
                            <img src="{{ $category->image_url }}"
                                 class="rounded-circle mb-3"
                                 width="72" height="72"
                                 style="object-fit:cover">
                            <h6 class="mb-1">{{ $category->name }}</h6>
                            <small class="text-muted">
                                {{ $category->products_count }} produk
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PRODUK UNGGULAN ================= --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 fade-up">
            <h2 class="section-title mb-0">Produk Unggulan</h2>
            <a href="{{ route('catalog.index') }}"
               class="text-decoration-none text-brand fw-semibold"
               id="lihat">
                Lihat Semua
            </a>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $i => $product)
            <div class="col-6 col-md-4 col-lg-3 fade-up"
                 style="transition-delay: {{ $i * 0.08 }}s">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PROMO ================= --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 fade-up">
                <div class="card card-soft bg-brand-gradient shadow-sm h-100 hover-zoom">
                    <div class="card-body">
                        <h4 class="fw-semibold">Flash Sale</h4>
                        <p class="text-muted">Diskon hingga 50% untuk produk pilihan</p>
                        <a href="#" class="btn btn-brand">Lihat Promo</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 fade-up" style="transition-delay:.15s">
                <div class="card card-soft bg-light shadow-sm h-100 hover-zoom">
                    <div class="card-body">
                        <h4 class="fw-semibold">Member Baru?</h4>
                        <p class="text-muted">Voucher Rp 50.000 untuk pembelian pertama</p>
                        <a href="{{ route('register') }}" class="btn btn-brand">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= PRODUK TERBARU ================= --}}
<section class="py-5">
    <div class="container">
        <h2 class="section-title mb-4 fade-up">Produk Terbaru</h2>

        <div class="row g-4">
            @foreach($latestProducts as $i => $product)
            <div class="col-6 col-md-4 col-lg-3 fade-up"
                 style="transition-delay: {{ $i * 0.08 }}s">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= SCROLL SCRIPT ================= --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
});
</script>

@endsection
