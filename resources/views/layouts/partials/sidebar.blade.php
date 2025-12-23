<nav class="pc-sidebar pc-trigger">
    <div class="navbar-wrapper" style="display: block;">
        <div class="m-header">
            <a href="../dashboard/index.html" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="../assets/images/logo-dark.svg" alt="" class="logo logo-lg">
            </a>
        </div>
        <div class="navbar-content pc-trigger active simplebar-scrollable-y" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: -10px 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                            aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 10px 0px;">
                                <ul class="pc-navbar" style="display: block;">
                                    <li class="pc-item pc-caption">
                                        <label>Dashboard</label>
                                        <i class="ti ti-dashboard"></i>
                                    </li>
                                    <li class="pc-item active">
                                        <a href="../dashboard/index.html" class="pc-link"><span class="pc-micon"><i
                                                    class="ti ti-home"></i></span><span
                                                class="pc-mtext">Dasboard</span></a>
                                    </li>

                                    <li class="pc-item pc-caption">
                                        <label>Main Menu</label>
                                        <i class="ti ti-apps"></i>
                                    </li>
                                    <li class="pc-item">
                                        <a href="{{ route('admin.products.index') }}" class="pc-link">
                                            <span class="pc-micon"><i class="bi bi-bag"></i></span>
                                            <span class="pc-mtext">Produk</span>
                                        </a>
                                    </li>
                                    <li class="pc-item">
                                        <a href="{{ route('admin.categories.index') }}" class="pc-link">
                                            <span class="pc-micon"><i class="bi bi-tag"></i></span>
                                            <span class="pc-mtext">Kategori</span>
                                        </a>
                                    </li>



                                    <li class="pc-item pc-hasmenu">
                                        <a href="#!" class="pc-link"><span class="pc-micon"><i
                                                    class="ti ti-menu"></i></span><span class="pc-mtext">Menu
                                                levels</span><span class="pc-arrow"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-chevron-right">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg></span></a>
                                        <ul class="pc-submenu" style="display: none;">
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>


                                        </ul>
                                    </li>



                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class=" text-danger">
                                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>

                                <div class="w-100 text-center">
                                    <div class="badge theme-version badge rounded-pill bg-light text-dark f-12"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: 260px; height: 795px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar"
                    style="height: 84px; transform: translate3d(0px, 21px, 0px); display: block;"></div>
            </div>
        </div>
    </div>
</nav>