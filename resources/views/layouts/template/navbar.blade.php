<style>
    .badge {
        animation: pop .3s ease;
    }

    @keyframes pop {
        from {
            transform: scale(.5);
        }

        to {
            transform: scale(1);
        }
    }

    .hover-shadow {
        transition: all .25s ease;
    }

    .hover-shadow:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, .15);
        transform: translateY(-2px);
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<header>
    <div class="container-fluid position-fixed top-0 start-0 end-0 bg-white shadow-sm" style="z-index: 1030;">

        {{-- ================= TOP HEADER ================= --}}
        <div class="row py-3 border-bottom align-items-center">

            {{-- LOGO --}}
            <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                <a href="{{ url('/') }}">
                    <img src="{{asset('images/logoDistro2.png')}}" class="img-fluid" alt="logo" width="210">
                </a>
            </div>

            {{-- SEARCH (LOGIN ONLY) --}}
            <div class="col-lg-5 d-none d-lg-block">
                <div class="search-bar row bg-light p-2 my-2 rounded-4">
                    <div class="col-md-4 d-none d-md-block">
                        <select class="form-select border-0 bg-transparent">
                            <option>All Categories</option>
                        </select>
                    </div>
                    <div class="col-11 col-md-7">
                        <input class="form-control border-0 bg-transparent" placeholder="Cari produk...">
                    </div>
                    <div class="col-1">
                        <i class="bi bi-search"></i>
                    </div>
                </div>
            </div>
            @auth

            @endauth

            {{-- RIGHT ACTION --}}
            <div class="col-sm-8 col-lg-4 d-flex justify-content-end gap-4 align-items-center">

                {{-- KATALOG (SELALU TAMPIL) --}}
                <a href="{{ route('catalog.index') }}" class="nav-link text-dark fw-bold">
                    Katalog <i class="bi bi-grid ms-1"></i>
                </a>

                {{-- ================= LOGIN ================= --}}
                @auth

                    {{-- USER + WISHLIST --}}
                    <ul class="list-unstyled d-flex align-items-center m-0">

                        {{-- USER --}}
                        <li class="dropdown">
                            <a class=" p-3 dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="{{ auth()->user()->avatar_url }}" width="40" height="40" class="rounded-circle">
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person me-2"></i> Profil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">
                                        <i class="bi bi-bag me-2"></i> Pesanan
                                    </a>
                                </li>

                                @if (auth()->user()->isAdmin())
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-primary" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-joystick me-2"></i> Admin
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item text-muted">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>

                        {{-- WISHLIST --}}
                        <li>
                            <a href="{{ route('wishlist.index') }}"
                                class="rounded-circle bg-light p-2  mx-2 ms-1 position-relative">
                                <i class="bi bi-heart"></i>
                                @if ($wishlistCount ?? 0)
                                    <span class="badge rounded-pill  position-absolute top-0 start-100 translate-middle"
                                        style="font-size: 0.6rem; background-color: #ff4081;">
                                        {{ $wishlistCount }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    </ul>

                    {{-- CART --}}
                    <div class="text-end">
                        <button class="btn btn-light position-relative" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasCart">
                            <i class="bi bi-cart fs-5"></i>

                            @if (!empty($totalQty))
                                <span
                                    class="badge bg-primary rounded-pill position-absolute top-0 start-100 translate-middle">
                                    {{ $totalQty }}
                                </span>
                            @endif
                        </button>

                        <span class="fw-bold ms-2">
                            Rp{{ number_format($totalPrice ?? 0) }}
                        </span>
                    </div>


                    {{-- ================= GUEST ================= --}}
                @else
                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}"
                            class="px-3 py-2 rounded-pill bg-light fw-semibold hover-shadow text-decoration-none text-dark">
                            <i class="bi bi-box-arrow-in-right"></i> Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-person-plus"></i> Daftar
                        </a>
                    </div>
                @endauth

            </div>
        </div>

    </div>
</header>
{{-- checkout modal --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Keranjang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">

        @if (isset($cart) && $cart->items->count())

            <ul class="list-group list-group-flush">

                @foreach ($cart->items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-start">

                        <div>
                            <div class="fw-semibold">{{ $item->product->name }}</div>
                            <small class="text-muted">
                                {{ $item->quantity }} × Rp{{ number_format($item->product->final_price, 0) }}
                            </small>
                        </div>

                        <span class="fw-bold">
                            Rp{{ number_format($item->product->final_price * $item->quantity, 0) }}
                        </span>

                    </li>
                @endforeach

            </ul>

            <div class="border-top pt-3 mt-3 d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span>Rp{{ number_format($cart->items->sum('subtotal'), 0) }}</span>
            </div>

            <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 mt-3">
                Checkout
            </a>

            <a href="{{ route('cart.index') }}" class="btn btn-secondary w-100 mt-3">
                Lihat Keranjang
            </a>
        @else
            <p class="text-center text-muted mt-4">
                Keranjang masih kosong
            </p>
            
        @endif

    </div>
</div>
<div class="container-fluid">
    <div class="row py-3">
      <div class="d-flex  justify-content-center justify-content-sm-between align-items-center">
        <nav class="main-menu d-flex navbar navbar-expand-lg">

          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

            <div class="offcanvas-header justify-content-center">
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
          
              <select class="filter-categories border-0 mb-0 me-5">
                <option>Shop by Departments</option>
                <option>Groceries</option>
                <option>Drinks</option>
                <option>Chocolates</option>
              </select>
          
              <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                <li class="nav-item active">
                  <a href="#women" class="nav-link">Women</a>
                </li>
                <li class="nav-item dropdown">
                  <a href="#men" class="nav-link">Men</a>
                </li>
                <li class="nav-item">
                  <a href="#kids" class="nav-link">Kids</a>
                </li>
                <li class="nav-item">
                  <a href="#accessories" class="nav-link">Accessories</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                  <ul class="dropdown-menu" aria-labelledby="pages">
                    <li><a href="index.html" class="dropdown-item">About Us </a></li>
                    <li><a href="index.html" class="dropdown-item">Shop </a></li>
                    <li><a href="index.html" class="dropdown-item">Single Product </a></li>
                    <li><a href="index.html" class="dropdown-item">Cart </a></li>
                    <li><a href="index.html" class="dropdown-item">Checkout </a></li>
                    <li><a href="index.html" class="dropdown-item">Blog </a></li>
                    <li><a href="index.html" class="dropdown-item">Single Post </a></li>
                    <li><a href="index.html" class="dropdown-item">Styles </a></li>
                    <li><a href="index.html" class="dropdown-item">Contact </a></li>
                    <li><a href="index.html" class="dropdown-item">Thank You </a></li>
                    <li><a href="index.html" class="dropdown-item">My Account </a></li>
                    <li><a href="index.html" class="dropdown-item">404 Error </a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#brand" class="nav-link">Brand</a>
                </li>
                <li class="nav-item">
                  <a href="#sale" class="nav-link">Sale</a>
                </li>
                <li class="nav-item">
                  <a href="#blog" class="nav-link">Blog</a>
                </li>
              </ul>
            
            </div>

          </div>
      </div>
    </div>
  </div>
<script>
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
                const badge = document.querySelector('.wishlist-badge');

                if (data.count > 0) {
                    if (!badge) {
                        location.reload(); // simpel & aman
                    } else {
                        badge.textContent = data.count;
                    }
                }
            });
    }
</script>
