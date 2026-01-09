<style>
    .badge {
        animation: pop 0.3s ease;
    }

    @keyframes pop {
        0% {
            transform: scale(0.5);
        }

        100% {
            transform: scale(1);
        }
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<header>
    <div class="container-fluid">
        <div class="row py-3 border-bottom">

            <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                <div class="main-logo">
                    <a href="index.html">
                        <img src="images/logo.png" alt="logo" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
                <div class="search-bar row bg-light p-2 my-2 rounded-4">
                    <div class="col-md-4 d-none d-md-block">
                        <select class="form-select border-0 bg-transparent">
                            <option>All Categories</option>
                            <option>Groceries</option>
                            <option>Drinks</option>
                            <option>Chocolates</option>
                        </select>
                    </div>
                    <div class="col-11 col-md-7">
                        <form id="search-form" class="text-center" action="index.html" method="post">
                            <input type="text" class="form-control border-0 bg-transparent"
                                placeholder="Search for more than 20,000 products" />
                        </form>
                    </div>
                    <div class="col-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
                <div class="support-box text-end  d-xl-block nav-item">
                    <a href="{{ route('catalog.index') }}" class="nav-link text-dark fw-bold">
                        Katalog <i class="bi bi-grid ms-1"></i>
                    </a>
                </div>

                <ul class="d-flex justify-content-end list-unstyled m-0">

                    {{-- User Account --}}
                    <li class="dropdown">
                        <a href="#" class="rounded-circle bg-light p-2 mx-1 dropdown-toggle" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">

                            <img src="{{ auth()->user()->avatar_url }}" class="rounded-circle " width="32">

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i> Profil Saya
                                </a>
                            </li>



                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="bi bi-bag me-2"></i> Pesanan Saya
                                </a>
                            </li>

                            @auth
                                @if (auth()->user()->isAdmin())
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-primary fw-semibold"
                                            href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-joystick me-2"></i> Dashboard Admin
                                        </a>
                                    </li>
                                @endif
                            @endauth

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

                    {{-- Wishlist --}}
                    <li>
                        <a href="{{ route('wishlist.index') }}"
                            class="rounded-circle bg-light p-2 mx-1 position-relative">

                            <svg width="24" height="24" viewBox="0 0 24 24">
                                <use xlink:href="#heart"></use>
                            </svg>

                            {{-- Badge Wishlist --}}
                            @auth
                                @if (isset($wishlistCount) && $wishlistCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                                        style="background-color: #ff4081;">
                                        {{ $wishlistCount }}
                                    </span>
                                @endif
                            @endauth

                        </a>
                    </li>


                    {{--  Search --}}
                    <li class="d-lg-none">
                        <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
                            <svg width="24" height="24" viewBox="0 0 24 24">
                                <use xlink:href="#search"></use>
                            </svg>
                        </a>
                    </li>
                </ul>

                {{-- CART --}}
                <div class="col-lg-3 text-end">

                    <button class="btn btn-light position-relative" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasCart">

                        <i class="bi bi-cart fs-5"></i>

                        @if (isset($totalQty) && $totalQty > 0)
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                {{ $totalQty }}
                            </span>
                        @endif
                    </button>

                    <span class="ms-2 fw-bold">
                        ${{ number_format($cart->items->sum('subtotal'), 2) }}
                    </span>

                </div>
            </div>

        </div>
    </div>
    <div class="container-fluid">
        <div class="row py-3">
            <div class="d-flex  justify-content-center justify-content-sm-between align-items-center">
                <nav class="main-menu d-flex navbar navbar-expand-lg">

                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">

                        <div class="offcanvas-header justify-content-center">
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body">



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
                                    <a class="nav-link dropdown-toggle" role="button" id="pages"
                                        data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
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

</header>

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
                                {{ $item->quantity }} × ${{ number_format($item->product->final_price, 2) }}
                            </small>
                        </div>

                        <span class="fw-bold">
                            ${{ number_format($item->product->final_price * $item->quantity, 2) }}
                        </span>

                    </li>
                @endforeach

            </ul>

            <div class="border-top pt-3 mt-3 d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span>${{ number_format($cart->items->sum('subtotal'), 2) }}</span>
            </div>

            <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 mt-3">
                Checkout
            </a>
        @else
            <p class="text-center text-muted mt-4">
                Keranjang masih kosong
            </p>
        @endif

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
