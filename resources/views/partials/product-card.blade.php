{{-- ================================================
FILE: resources/views/partials/product-card.blade.php
FUNGSI: Komponen kartu produk yang reusable
================================================ --}}

<style>
    .product-card {
        border-radius: 8px;
        transition: .2s ease;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-4px);
    }

    .product-image {
        height: 200px;
        object-fit: cover;
        background: #f8f9fa;
    }

    .badge-discount {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #e53935;
        color: #fff;
        font-size: .75rem;
        padding: 4px 8px;
        border-radius: 8px;
        font-weight: 600;
    }

    .wishlist-btn {
        background: #fff;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
    }

    .price {
        color: #5b8a95;
        font-weight: 700;
    }

    .btn-cart {
        background-color: #7faab6;
        border-color: #7faab6;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-cart:hover {
        background-color: #6b98a5;
        border-color: #6b98a5;
    }
</style>
<div class="product-item">
    <div class="card product-card h-100 border-0 shadow-sm">

        {{-- Image --}}
        <div class="position-relative">
            <a href="{{ route('catalog.show', $product->slug) }}">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-100 product-image">
            </a>

            {{-- Diskon --}}
            @if ($product->has_discount)
                <span class="badge-discount">
                    -{{ $product->discount_percentage }}%
                </span>
            @endif

            {{-- Wishlist --}}
            @auth
                <button type="button" onclick="toggleWishlist({{ $product->id }})"
                    class="btn btn-sm position-absolute top-0 end-0 m-2 rounded-circle wishlist-btn wishlist-btn-{{ $product->id }}">
                    <i
                        class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
                </button>
            @endauth
        </div>

        {{-- Body --}}
        <div class="card-body d-flex flex-column p-3">

            <small class="text-muted mb-1">
                {{ $product->category->name }}
            </small>

            <h6 class="mb-2 lh-sm">
                <a href="{{ route('catalog.show', $product->slug) }}"
                    class="text-decoration-none text-dark stretched-link">
                    {{ Str::limit($product->name, 42) }}
                </a>
            </h6>

            {{-- Harga --}}
            <div class="mt-auto">
                @if ($product->has_discount)
                    <small class="text-muted text-decoration-line-through">
                        {{ $product->formatted_original_price }}
                    </small>
                @endif

                <div class="price">
                    {{ $product->formatted_price }}
                </div>
            </div>

            {{-- Stok --}}
            @if ($product->stock <= 5 && $product->stock > 0)
                <small class="text-warning mt-2">
                    <i class="bi bi-exclamation-circle"></i>
                    Stok {{ $product->stock }}
                </small>
            @elseif($product->stock == 0)
                <small class="text-danger mt-2">
                    <i class="bi bi-x-circle"></i> Stok Habis
                </small>
            @endif
        </div>

        {{-- Footer --}}
        <div class="px-3 pb-3">
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">

                <button type="submit" class="btn btn-cart btn-sm w-100"
                    @if ($product->stock == 0) disabled @endif>
                    <i class="bi bi-cart-plus me-1"></i>
                    {{ $product->stock == 0 ? 'Stok Habis' : 'Tambah Keranjang' }}
                </button>
            </form>
        </div>

    </div>
</div>
