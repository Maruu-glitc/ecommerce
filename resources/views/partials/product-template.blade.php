<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="col">
    <div class="product-item card h-100 d-flex flex-column overflow-hidden">

        {{-- Badge Diskon --}}
        @if ($product->has_discount)
            <span class="badge bg-success position-absolute top-0 start-0 m-2 z-1">
                -{{ $product->discount_percentage }}%
            </span>
        @endif

        {{-- Wishlist --}}
        {{-- @auth
            <button type="button" onclick="toggleWishlist({{ $product->id }})"
                class="btn btn-light position-absolute top-0 end-0 m-2 z-1 wishlist-btn-{{ $product->id }}">
                <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
            </button>
        @endauth --}}
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">



            @auth
                <button type="button" onclick="confirmWishlist({{ $product->id }})"
                    class="btn  btn-light position-absolute top-0 end-0 m-2 z-1  wishlist-btn wishlist-btn-{{ $product->id }}">
                    <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill ' : 'bi-heart ' }}"></i>
                </button>
            @endauth


            {{-- Gambar --}}
            <a href="{{ route('catalog.show', $product->slug) }}" class="ratio ratio-1x1">
                <img src="{{ $product->image_url }}" class="card-img-top object-fit-cover" alt="{{ $product->name }}">
            </a>

            {{-- Body --}}
            <div class="card-body d-flex flex-column">
                {{-- Nama Produk --}}
                <h5 class="card-title text-truncate mb-1">
                    <a href="{{ route('catalog.show', $product->slug) }}" class="text-decoration-none text-dark">
                        {{ $product->name }}
                    </a>
                </h5>
                {{-- Kategori --}}
                <h6 class="card-title text-truncate mb-1">
                    {{ $product->category->name }}
                </h6>

                {{-- Stok --}}
                <div class="mb-1">
                    @if ($product->stock <= 5 && $product->stock > 0)
                        <span class="badge bg-warning text-dark">
                            Stok {{ $product->stock }}
                        </span>
                    @elseif ($product->stock > 5)
                        <span class="badge bg-success">
                            Tersedia
                        </span>
                    @elseif ($product->stock == 0)
                        <span class="badge bg-danger">
                            Stok Habis
                        </span>
                    @else
                        {{-- Placeholder supaya tinggi card konsisten --}}
                        <span class="badge bg-light text-light">&nbsp;</span>
                    @endif
                </div>

                {{-- Harga --}}
                <div class="mt-2">
                    @if ($product->has_discount)
                        <small class="text-muted text-decoration-line-through d-block">
                            Rp{{ number_format($product->price, 0) }}
                        </small>
                        <strong>
                            Rp{{ number_format($product->price - ($product->price * $product->discount_percentage) / 100, 0) }}
                        </strong>
                    @else
                        <strong>Rp{{ number_format($product->price, 0) }}</strong>
                    @endif
                </div>

                {{-- Quantity Selector --}}
                <div class="d-flex align-items-center justify-content-between">
                    <div class="input-group product-qty quantity-grid">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number btn-qty"
                                data-type="minus" onclick="decrementQty()">
                                <svg width="16" height="16">
                                    <use xlink:href="#minus"></use>
                                </svg>
                            </button>
                        </span>
                        <input type="number" id="quantity" name="quantity" class="form-control input-number"
                            value="1" min="1" max="{{ $product->stock }}">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number  btn-qty"
                                data-type="plus" onclick="incrementQty()">
                                <svg width="16" height="16">
                                    <use xlink:href="#plus"></use>
                                </svg>
                            </button>
                        </span>
                    </div>
                </div>

                {{-- Spacer --}}
                <div class="mt-auto"></div>

                {{-- Action --}}
                {{-- <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                    @csrf --}}

                {{-- <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1"> --}}

                <button class="btn btn-dark w-100" @if ($product->stock == 0) disabled @endif>
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


<script>
    // function incrementQty() {
    //     const input = document.getElementById('quantity');
    //     const max = parseInt(input.max);
    //     if (parseInt(input.value) < max) {
    //         input.value = parseInt(input.value) + 1;
    //     }
    // }

    // function decrementQty() {
    //     const input = document.getElementById('quantity');
    //     if (parseInt(input.value) > 1) {
    //         input.value = parseInt(input.value) - 1;
    //     }
    // }


    function incrementQty(id) {
        const input = document.getElementById(`quantity-${id}`);
        const max = parseInt(input.max);
        if (parseInt(input.value) < max) {
            input.value++;
        }
    }

    function decrementQty(id) {
        const input = document.getElementById(`quantity-${id}`);
        if (parseInt(input.value) > 1) {
            input.value--;
        }
    }



    function confirmWishlist(productId) {
        const btn = document.querySelector(`.wishlist-btn-${productId}`);
        const icon = btn.querySelector('i');

        const isAdded = icon.classList.contains('bi-heart-fill');

        // Jalankan fungsi lama kamu
        toggleWishlist(productId);

        // Tampilkan SweetAlert
        Swal.fire({
            // toast: true,
            // position: 'top',
            icon: isAdded ? 'info' : 'success',
            iconColor: isAdded ? 'red' : '#FFC400',
            title: isAdded ?
                'Produk dihapus dari wishlist' : 'Produk berhasil ditambahkan ke wishlist',
            showConfirmButton: false,
            timer: 3000
        });
    }
</script>
