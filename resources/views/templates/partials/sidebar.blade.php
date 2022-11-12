<div class="sticky" style="margin-bottom: -74px;">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar ps ps--active-y sidemenu-scroll">
        <div class="side-header"> <a class="header-brand1" href="{{route('dashboard.index')}}"> 
            <img src="{{asset('assets/images/logo.png')}}" class="header-brand-img desktop-logo" alt="logo"> 
            <img src="{{asset('assets/images/logo.png')}}" class="header-brand-img toggle-logo" alt="logo"> 
            <img src="{{asset('assets/images/logo.png')}}" class="header-brand-img light-logo" alt="logo"> 
            <img src="{{asset('assets/images/logo.png')}}"
            class="header-brand-img light-logo1" style="width: 70px" alt="logo"> </a> <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                    </path>
                </svg></div>
            <ul class="side-menu" style="margin-right: 0px; margin-left: 0px;">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide"> 
                    <a class="side-menu__item has-link {{Request::is('dashboard') ? 'active' : (Request::is('/') ? 'active' : '') }}" data-bs-toggle="slide"
                        href="{{route('dashboard.index')}}"><i class="side-menu__icon fe fe-home"></i><span
                            class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                <li class="slide"> 
                    <a class="side-menu__item has-link {{Request::is('category') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('category.index')}}"><i class="side-menu__icon fe fe-layers"></i><span
                            class="side-menu__label">Kategori</span>
                    </a>
                </li>
                <li class="slide"> 
                    <a class="side-menu__item has-link {{Request::is('product') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('product.index')}}"><i class="side-menu__icon fe fe-pie-chart"></i><span
                            class="side-menu__label">Produk</span>
                    </a>
                </li>
                @can('admin')
                <li class="slide"> 
                    <a class="side-menu__item has-link {{Request::is('staff') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('staff.index')}}"><i class="side-menu__icon fe fe-users"></i><span
                            class="side-menu__label">Staff</span>
                    </a>
                </li>
                @endcan
                <li class="slide"> 
                    <a class="side-menu__item has-link {{Request::is('sale') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('sale.index')}}"><i class="side-menu__icon fe fe-shopping-bag"></i><span
                            class="side-menu__label">Transaksi</span>
                    </a>
                </li>
                <li class="slide"> 
                    <a class="side-menu__item has-link {{Request::is('sale/detail') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('sale.detail')}}"><i class="side-menu__icon fe fe-shopping-cart"></i><span
                            class="side-menu__label">Detail Transaksi</span>
                    </a>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                    </path>
                </svg></div>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: -558px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 558px; height: 969px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 314px; height: 544px;"></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>