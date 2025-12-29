@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="container py-4">
    <div class="row g-4">

        {{-- FILTER (Desktop Sidebar) --}}
        <aside class="col-lg-3 d-none d-lg-block">
            <div class="border rounded p-3">
                <h6 class="fw-semibold mb-3">
                    <i class="bi bi-funnel me-1"></i> Filter
                </h6>

                <form action="{{ route('catalog.index') }}" method="GET">
                    @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif

                    {{-- Category --}}
                    <div class="mb-4">
                        <small class="fw-semibold text-muted">Kategori</small>
                        @foreach($categories as $category)
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="category" value="{{ $category->slug }}"
                                {{ request('category')==$category->slug ? 'checked' : '' }}
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
                            <input type="number" class="form-control form-control-sm" name="min_price" placeholder="Min"
                                value="{{ request('min_price') }}">
                            <input type="number" class="form-control form-control-sm" name="max_price" placeholder="Max"
                                value="{{ request('max_price') }}">
                        </div>
                        <button class="btn btn-sm btn-dark w-100 mt-2">
                            Terapkan
                        </button>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="on_sale" value="1" {{ request('on_sale')
                            ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="form-check-label">
                            Diskon
                        </label>
                    </div>
                </form>
            </div>
        </aside>

        {{-- PRODUCT LIST --}}
        <main class="col-lg-9">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-0 fw-semibold">
                        @if(request('q'))
                        "{{ request('q') }}"
                        @elseif(request('category'))
                        {{ $categories->firstWhere('slug', request('category'))?->name }}
                        @else
                        Semua Produk
                        @endif
                    </h5>
                    <small class="text-muted">{{ $products->total() }} produk</small>
                </div>

                <select class="form-select form-select-sm w-auto" onchange="location.href=this.value">
                    <option value="{{ request()->fullUrlWithQuery(['sort'=>'newest']) }}">Terbaru</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort'=>'price_asc']) }}">Harga ↑</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort'=>'price_desc']) }}">Harga ↓</option>
                </select>
            </div>

            {{-- Grid --}}
            @if($products->count())
            <div class="row g-3">
                @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('partials.product-card')
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
            @else
            <div class="text-center py-5 text-muted">
                <i class="bi bi-search fs-1"></i>
                <p class="mt-3">Produk tidak ditemukan</p>
            </div>
            @endif
        </main>
    </div>
</div>
@endsection