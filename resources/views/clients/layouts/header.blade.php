<header class="header-style-2" id="home">
    <div class="header-top">
        <div class="d-flex justify-content-end align-items-center ms-auto theme-bg-color" style="height: 50px">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-phone text-white">
                <path
                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                </path>
            </svg><span class=" ms-2 me-5 text-white">(123) 456789</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-mail text-white">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
            </svg><span class="ms-2 me-5 text-white">thuexe123@gmail.com</span>
        </div>
    </div>
    <div class="main-header navbar-searchbar bg-white mb-1">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <div class="brand-logo">
                                <a href="/">
                                    <img src="{{ asset('images/logo.png') }}" class="h-logo img-fluid blur-up lazyload"
                                        alt="logo">
                                </a>
                            </div>

                        </div>
                        <nav>
                            <div class="main-navbar">
                                <div id="mainnav">
                                    <div class="toggle-nav">
                                        <i class="fa fa-bars sidebar-bar"></i>
                                    </div>
                                    <ul class="nav-menu">
                                        <li class="back-btn d-xl-none">
                                            <div class="close-btn">
                                                Menu
                                                <span class="mobile-back"><i class="fa fa-angle-left"></i>
                                                </span>
                                            </div>
                                        </li>
                                        <li><a href="/" class="nav-link menu-title fs-5 fw-bold">Trang chủ</a>
                                        </li>
                                        <li><a href="/product" class="nav-link menu-title fs-5 fw-bold">Thuê Xe</a>
                                        </li>
                                        <li><a href="/about" class="nav-link menu-title fs-5 fw-bold">Giới
                                                thiệu</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <div class="menu-right">
                            <ul>
                                <li>
                                    <div class="search-box theme-bg-color">
                                        <i data-feather="search"></i>
                                    </div>
                                </li>
                                <li class="onhover-dropdown wislist-dropdown">
                                    <div class="cart-media">
                                        <a href="wishlist/list.html">
                                            <i data-feather="heart"></i>
                                            <span id="wishlist-count" class="label label-theme rounded-pill">
                                                0
                                            </span>
                                        </a>
                                    </div>
                                </li>
                                <li class="onhover-dropdown wislist-dropdown">
                                    <div class="cart-media">
                                        <a href="/cart">
                                            <i data-feather="shopping-cart"></i>
                                            <span id="cart-count" class="label label-theme rounded-pill">
                                                {{ Cart::instance('cart')->content()->count() }}
                                            </span>
                                        </a>
                                    </div>
                                </li>
                                @if (Auth::check())
                                    <li class="onhover-dropdown">
                                        <div class="cart-media name-usr">
                                            <i data-feather="user"></i>
                                            <span class="ms-2">{{ Auth::user()->name }}</span>
                                        </div>
                                        <div class="onhover-div profile-dropdown">
                                            <ul>
                                                @if (Auth::user()->role != config('app.role.USER'))
                                                    <li>
                                                        <a href="/admin" class="d-block">Admin</a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a href="#" class="d-block">Profile</a>
                                                </li>
                                                <li>
                                                    <a href="/order" class="d-block">Theo dõi đơn hàng</a>
                                                </li>
                                                <li>
                                                    <a href="/logout" class="d-block">Đăng xuất</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </li>
                                @else
                                    <li class="onhover-dropdown">
                                        <div class="cart-media name-usr">
                                            <i data-feather="user"></i>
                                        </div>
                                        <div class="onhover-div profile-dropdown">
                                            <ul>
                                                <li>
                                                    <a href="/login" class="d-block">Login</a>
                                                </li>
                                                <li>
                                                    <a href="/register" class="d-block">Register</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="search-full">
                            <form method="GET" class="search-full" action="http://localhost:8000/search">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i data-feather="search" class="font-light"></i>
                                    </span>
                                    <input type="text" name="q" class="form-control search-type"
                                        placeholder="Search here..">
                                    <span class="input-group-text close-search">
                                        <i data-feather="x" class="font-light"></i>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="mobile-menu d-sm-none">
    <ul>
        <li>
            <a href="/" class="active">
                <i data-feather="home"></i>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a href="/cart">
                <i data-feather="shopping-bag"></i>
                <span>Cart</span>
            </a>
        </li>
        <li>
            <a href="/">
                <i data-feather="user"></i>
                <span>Account</span>
            </a>
        </li>
    </ul>
</div>
