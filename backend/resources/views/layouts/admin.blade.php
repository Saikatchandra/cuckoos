<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('style')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="{{ asset('admin') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Dashboard</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if(auth()->user()->avatar)
                        <img  style="width:35px; height:35px;border-radius:50%;object-fit:cover;" src="{{ asset(auth()->user()->avatar) }}" alt="User Avatar">
                        @else
                        <img  style="width:35px; height:35px;border-radius:50%;object-fit:cover;" src="{{ asset('admin') }}/dist/img/user.png" alt="User Avatar">
                        @endif
                    </div>
                    <div class="info">
                        <a href="{{ route('user.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('*/dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @php $menu = request()->is('*/affiliate*') || request()->is('*/comission*') || request()->is('*/transaction*') @endphp 
                        <li class="nav-item has-treeview {{ $menu ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Affiliate
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="{{ $menu ? 'display: block' : 'display: none' }};">
                                <li class="nav-item">
                                    <a href="{{ route('affiliate') }}" class="nav-link {{ request()->is('*/affiliate*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Affiliate Dashboard</p>
                                    </a>
                                </li>
                                @can('comission index')
                                <li class="nav-item">
                                    <a href="{{ route('comission.index') }}" class="nav-link {{ request()->is('*/comission*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Affiliate Comission</p>
                                    </a>
                                </li>
                                @endcan
                                @can('transaction index')
                                <li class="nav-item">
                                    <a href="{{ route('transaction.index') }}" class="nav-link {{ request()->is('*/transaction*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transaction History</p>
                                    </a>
                                </li>
                                @endcan
                                @can('transaction request')
                                <li class="nav-item">
                                    <a href="{{ route('transaction.request') }}" class="nav-link {{ request()->is('*/transaction/request*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Withdraw Request</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @can('category index')
                        <li class="nav-item">
                            
                        </li>
                        @endcan
                        @php $menu = request()->is('*/product*') || request()->is('*/product-category*') || request()->is('*/subcategory*') || request()->is('*/product-brand*') @endphp 
                        <li class="nav-item has-treeview {{ $menu ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th-large"></i>
                                <p>
                                    Product Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="{{ $menu ? 'display: block' : 'display: none' }};">
                                @can('product index')
                                <li class="nav-item">
                                    <a href="{{ route('product.index') }}" class="nav-link {{ request()->is('*/product/*') || request()->is('*/product') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Product </p>
                                    </a>
                                </li>
                                @endcan
                                @can('category index')
                                <li class="nav-item">
                                    <a href="{{ route('product-category.index') }}" class="nav-link {{ request()->is('*/product-category*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Product Category </p>
                                    </a>
                                </li>
                                @endcan
                                @can('subcategory index')
                                <li class="nav-item">
                                    <a href="{{ route('subcategory.index') }}" class="nav-link {{ request()->is('*/subcategory*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Product Sub Category </p>
                                    </a>
                                </li>
                                @endcan
                                @can('brand index')
                                <li class="nav-item">
                                    <a href="{{ route('product-brand.index') }}" class="nav-link {{ request()->is('*/product-brand*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Product Brand
                                        </p>
                                    </a>
                                </li>
                                @endcan
                                <li class="nav-item">
                                    <a href="{{ route('product.stock') }}" class="nav-link {{ request()->is('*/product-stock') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Out of Stock Products
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @can('slider edit')
                        <li class="nav-item">
                            <a href="{{ route('slider.edit') }}" class="nav-link {{ request()->is('*/slider*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-star"></i>
                                <p>
                                    Slider Settings
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('campaign index')
                        <li class="nav-item">
                            <a href="{{ route('campaign.index') }}" class="nav-link {{ request()->is('*/campaign*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-bullhorn"></i>
                                <p>
                                    Campaign
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('order index')
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}" class="nav-link {{ request()->is('*/order*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>
                                    Order
                                </p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route('rating.index') }}" class="nav-link {{ request()->is('*/rating*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-star"></i>
                                <p>
                                    Rating
                                </p>
                            </a>
                        </li>
                        @can('billing index')
                        <li class="nav-item">
                            <a href="{{ route('billing.index') }}" class="nav-link {{ request()->is('*/billing*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Billing
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('shipping index')
                        <li class="nav-item">
                            <a href="{{ route('shipping.index') }}" class="nav-link {{ request()->is('*/shipping*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-truck"></i>
                                <p>
                                    Shipping
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('coupon index')
                        <li class="nav-item">
                            <a href="{{ route('coupon.index') }}" class="nav-link {{ request()->is('*/coupon*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-percentage"></i>
                                <p>
                                    Coupon
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="" class="nav-link {{ request()->is('*/user*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li> --}}
                        @endcan
                        <li class="nav-item has-treeview {{ request()->is('*/user*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Users
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="{{ request()->is('*/user*') ? 'display: block' : 'display: none' }};">
                                @can('user index')
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('*/user*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User List</p>
                                    </a>
                                </li>
                                @endcan
                                @can('user kyc')
                                <li class="nav-item">
                                    <a href="{{ route('user.kyc') }}" class="nav-link {{ request()->is('*/user-kyc*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User KYC </p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @can('setting index')
                        <li class="nav-item">
                            <a href="{{ route('setting.edit') }}" class="nav-link {{ request()->is('*/setting*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Setting
                                </p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-header">Your Account</li>
                        <li class="nav-item mt-auto">
                            <a href="{{ route('user.profile') }}" class="nav-link {{ request()->is('*/profile') ? 'active' : '' }}">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    Your Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item mt-auto">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                        <li class="text-center mt-5">
                            <a href="{{ env('SITE_URL', 'https://cuckoos.shop') }}" class="btn btn-primary text-white" target="_blank">
                                <p class="mb-0">
                                    View Website
                                </p>
                            </a>                    
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">Hash Tech Technologies</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin') }}/dist/js/bs-custom-file-input.js"></script>
    <script src="{{ asset('admin') }}/plugins/toastr/toastr.min.js"></script>
    <script src="{{ asset('admin') }}/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        })
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}", 'Success!')
        @endif
        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}", 'Error!')
        @endif
    </script>
    @yield('script')
</body>

</html>
