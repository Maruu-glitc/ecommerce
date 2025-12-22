<nav class="pc-sidebar pc-trigger">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('admin.dashboard') }}" class="b-brand text-primary">
                <span style="font-size:20px;font-weight:700;">MyStore Admin</span>
            </a>
        </div>

        <div class="navbar-content">
            <ul class="pc-navbar">

                {{-- Dashboard --}}
                <li class="pc-item ">
                    <a href="{{ route('admin.dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class='bx bx-home-alt-2'></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Main Menu</label>
                </li>

                {{-- Produk --}}
                <li class="pc-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}" class="pc-link">
                        <span class="pc-micon"><i class='bx bx-shopping-bag'></i></span>
                        <span class="pc-mtext">Produk</span>
                    </a>
                </li>

                {{-- Kategori --}}
                <li class="pc-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}" class="pc-link">
                        <span class="pc-micon"><i class='bx bx-dashboard'></i></span>
                        <span class="pc-mtext">Kategori</span>
                    </a>
                </li>

                {{-- User --}}
                <li class="pc-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class='bx bx-user'></i></span>
                        <span class="pc-mtext">User</span>
                    </a>
                </li>

                {{-- Pesanan --}}
                <li class="pc-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class='bx bx-box'></i></span>
                        <span class="pc-mtext">Pesanan</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>