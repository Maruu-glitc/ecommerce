<div class="col">
    <div class="product-item card h-100 d-flex flex-column overflow-hidden">

        {{-- Badge Diskon --}}
        @if ($product->has_discount)
            <span class="badge bg-success position-absolute top-0 start-0 m-2 z-1">
                -{{ $product->discount_percentage }}%
            </span>
        @endif

        {{-- Wishlist --}}
        @auth
            <button type="button"
                onclick="toggleWishlist({{ $product->id }})"
                class="btn btn-light position-absolute top-0 end-0 m-2 z-1">
                <i class="bi bi-heart"></i>
            </button>
        @endauth

        {{-- Gambar --}}
        <a href="{{ route('catalog.show', $product->slug) }}"
           class="ratio ratio-1x1">
            <img src="{{ $product->image_url }}"
                 class="card-img-top object-fit-cover"
                 alt="{{ $product->name }}">
        </a>

        {{-- Body --}}
        <div class="card-body d-flex flex-column">

            <h6 class="card-title text-truncate mb-1">
                {{ $product->category->name }}
            </h6>

            @if ($product->stock <= 5 && $product->stock > 0)
                <small class="text-warning">Stok {{ $product->stock }}</small>
            @elseif ($product->stock == 0)
                <small class="text-danger">Stok habis</small>
            @else
                <small class="text-muted">&nbsp;</small>
            @endif

            {{-- Harga --}}
            <div class="mt-2">
                @if ($product->has_discount)
                    <small class="text-muted text-decoration-line-through d-block">
                        ${{ number_format($product->price, 2) }}
                    </small>
                    <strong class="text-dark">
                        ${{ number_format(  
                            $product->price - ($product->price * $product->discount_percentage / 100),
                            2
                        ) }}
                    </strong>
                @else
                    <strong>${{ number_format($product->price, 2) }}</strong>
                @endif
            </div>

            {{-- Spacer --}}
            <div class="mt-auto"></div>

            {{-- Action --}}
            <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                @csrf
                <button class="btn btn-dark w-100"
                        @if($product->stock == 0) disabled @endif>
                    <i class="bi bi-cart"></i> Tambah ke Keranjang
                </button>
            </form>

        </div>
    </div>
</div>
<style>
    .product-item {
    position: relative;
}

.object-fit-cover {
    object-fit: cover;
}

</style>