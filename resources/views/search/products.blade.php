@extends('layouts.admin')

@section('content')
<div class="container py-5">

    <h4 class="mb-4">
        Hasil pencarian: "{{ $keyword }}"
    </h4>

    @if($products->isEmpty())
    <div class="alert alert-warning">
        Produk tidak ditemukan.
    </div>
    @else
    <div class="row g-4">
        @foreach($products as $product)
        <div class="col-md-3">
            <div class="card h-100">
                <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">

                <div class="card-body">
                    <h6 class="fw-bold">{{ $product->name }}</h6>

                    <p class="mb-1 text-muted">
                        {{ $product->formatted_price }}
                    </p>

                    @if($product->has_discount)
                    <small class="text-danger">
                        -{{ $product->discount_percentage }}%
                    </small>
                    @endif
                </div>

                <div class="card-footer bg-white">
                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-primary w-100">
                        Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
    @endif

</div>
@endsection