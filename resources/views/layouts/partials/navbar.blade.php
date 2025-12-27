<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- [Mobile Media Block] start -->
    <div class="me-auto pc-mob-drp">
        <ul class="list-unstyled">
            <li class="pc-h-item header-mobile-collapse">
                <a href="#" class="pc-head-link head-link-secondary ms-0" id="sidebar-hide">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="pc-h-item pc-sidebar-popup">
                <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="dropdown pc-h-item d-inline-flex d-md-none">
                <a class="pc-head-link head-link-secondary dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ti ti-search"></i>
                </a>
                <div class="dropdown-menu pc-h-dropdown drp-search">
                    <form class="px-3">
                        <div class="mb-0 d-flex align-items-center">
                            <i data-feather="search"></i>
                            <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . ." />
                        </div>
                    </form>
                </div>
            </li>
            <li class="pc-h-item d-none d-md-inline-flex">
                <form class="header-search" action="{{ route('search') }}" method="GET" >
                    <i data-feather="search" class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Search here. . ." value="{{ request('q') }}" />
                    
                    <button class="btn btn-light-secondary btn-search"><i class="ti ti-adjustments-horizontal"></i></button>
                </form>
            </li>
        </ul>
    </div>
    <!-- [Mobile Media Block end] -->
    <div class="ms-auto">
        <ul class="list-unstyled">
            <li class="dropdown pc-h-item">
                <a class="pc-head-link head-link-secondary dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ti ti-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                    <div class="dropdown-header">
                        <a href="#!" class="link-primary float-end text-decoration-underline">Mark as all
                            read</a>
                        <h5>
                            All Notification
                            <span class="badge bg-warning rounded-pill ms-1">01</span>
                        </h5>
                    </div>
                    <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                        style="max-height: calc(100vh - 215px)">
                        <div class="list-group list-group-flush w-100">
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="user-avtar bg-light-success"><i class="ti ti-building-store"></i></div>
                                    </div>
                                    <div class="flex-grow-1 ms-1">
                                        <span class="float-end text-muted">3 min ago</span>
                                        <h5>Store Verification Done</h5>
                                        <p class="text-body fs-6">We have successfully received your request.
                                        </p>
                                        <div class="badge rounded-pill bg-light-danger">Unread</div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/images/user/avatar-3.jpg" alt="user-image" class="user-avtar" />
                                    </div>
                                    <div class="flex-grow-1 ms-1">
                                        <span class="float-end text-muted">10 min ago</span>
                                        <h5>Joseph William</h5>
                                        <p class="text-body fs-6">It is a long established fact that a reader
                                            will be distracted</p>
                                        <div class="badge rounded-pill bg-light-success">Confirmation of Account
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="text-center py-2">
                        <a href="#!" class="link-primary">Mark as all read</a>
                    </div>
                </div>
            </li>
            <li class="dropdown pc-h-item header-user-profile">
                <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar" />
                    <span>
                        <i class="ti ti-settings"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                    <div class="dropdown-header">
                        <h4>
                            Good Morning,
                            <span class="small " style="color: #451bfdaf;">{{ auth()->user()->name }}</span>
                        </h4>
                        <p class="text-muted">Project Admin</p>
                        <hr />
                        <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 280px)">
    
                            <a href="{{ route('home') }}" class="dropdown-item">
                                <i class="ti ti-home"></i>
                                <span>Home</span>
                            </a>
                            <a href="../application/account-profile-v1.html" class="dropdown-item">
                                <i class="ti ti-settings"></i>
                                <span>Account Settings</span>
                            </a>
                            <a href="/profile" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span>Social Profile</span>
                            </a>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</body>
</html>