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

    .bg-brand {
        background-color: var(--brand);
    }

    .bg-brand-gradient {
        background: linear-gradient(135deg, #BDDDE4, #eaf4f6);
    }

    .text-brand {
        color: var(--brand-dark);
    }

    .btn-brand {
        background-color: var(--brand-dark);
        color: #fff;
        border-radius: 12px;
        padding: .6rem 1.4rem;
        font-weight: 600;
    }

    .btn-brand:hover {
        background-color: #6b98a5;
        color: #fff;
    }

    .section-title {
        font-weight: 600;
        letter-spacing: .2px;
    }

    .card-soft {
        border: 0;
        border-radius: 16px;
        transition: .2s ease;
    }

    .card-soft:hover {
        transform: translateY(-4px);
    }

    h2 {
        background: linear-gradient(135deg, #eaf4f6, #BDDDE4);
        border-bottom-right-radius: 20px;
        border-top-right-radius: 20px;
        padding: 9px;
    }
    #kat{
        width: 26%;
    }

    #lihat:hover {
        color: #527b86;
    }
</style>

{{-- Hero --}}
<section class="bg-brand-gradient py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="fw-bold display-5 mb-3">
                    Belanja Kaos Simpel,<br>
                    Nyaman & Terpercaya
                </h1>
                <p class="text-muted mb-4 fs-5">
                    Koleksi kaos berkualitas dengan desain modern.
                    Cocok untuk semua gaya.
                </p>
                <a href="{{ route('catalog.index') }}" class="btn btn-brand btn-lg">
                    <i class="bi bi-bag me-2"></i>Mulai Belanja
                </a>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center">
                <img src="{{ asset('assets/images/kaosPNG.png') }}" class="img-fluid" style="max-height: 380px">
            </div>
        </div>
    </div>
</section>

{{-- Kategori --}}
<section class="py-5">
    <div class="container">
        <div class="">
            <h2 class="section-title  mb-4  " id="kat">Kategori Populer</h2>

            <div class="row g-4 justify-content-center">
                @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                        class="text-decoration-none text-dark">
                        <div class="card card-soft text-center h-100 shadow-sm">
                            <div class="card-body">
                                <img src="{{ $category->image_url }}" class="rounded-circle mb-3" width="72" height="72"
                                    style="object-fit: cover">
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

{{-- Produk Unggulan --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0" id="title">Produk Unggulan</h2>
            <a href="{{ route('catalog.index') }}" class="text-decoration-none text-brand fw-semibold" id="lihat">
                Lihat Semua     
            </a>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Promo --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-soft bg-brand-gradient shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h4 class="fw-semibold">Flash Sale</h4>
                        <p class="text-muted">
                            Diskon hingga 50% untuk produk pilihan
                        </p>
                        <a href="#" class="btn btn-brand w-fit">
                            Lihat Promo
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-soft bg-light shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h4 class="fw-semibold">Member Baru?</h4>
                        <p class="text-muted">
                            Voucher Rp 50.000 untuk pembelian pertama
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-brand w-fit">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Produk Terbaru --}}
<section class="py-5">
    <div class="container">
        <h2 class="section-title  mb-4 w-25 " id="title">Produk Terbaru</h2>

        <div class="row g-4">
            @foreach($latestProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection