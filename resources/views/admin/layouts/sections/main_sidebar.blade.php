@php
    $route = Route::current()->getName();
@endphp
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ url('/') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3><b>Sunny</b> Admin</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ $route == 'admin.dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{ $route == 'admin.brands' ? 'active' : '' }}">
                <a href="{{ route('admin.brands') }}">
                    <i data-feather="message-circle"></i>
                    <span>Brands</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.brands' ? 'active' : '' }}"><a href="{{ route('admin.brands') }}"><i
                                class="ti-more"></i>All Brands</a></li>

                </ul>
            </li>

            {{-- <li class="treeview {{ $route == 'admin.categories' ? 'active' : '' }}">
                <a href="{{ route('admin.categories') }}">
                    <i data-feather="mail"></i>
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.categories' ? 'active' : '' }}"><a href="{{ route('admin.categories') }}"><i
                                class="ti-more {{ $route == 'admin.categories' ? 'active' : '' }}"></i>All
                            categories</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.subcategories' ? 'active' : '' }}"><a href="{{ route('admin.subcategories') }}"><i
                                class="ti-more {{ $route == 'admin.subcategories' ? 'active' : '' }}"></i>All
                            subcategories</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.categories' ? 'active' : '' }}"><a href="{{ route('admin.categories') }}"><i
                                class="ti-more {{ $route == 'admin.categories' ? 'active' : '' }}"></i>All
                            categories</a></li>
                </ul>

            </li> --}}

            <li class="treeview {{ $route == 'admin.categories' ? 'active' : '' }}">
                <a href="{{ route('admin.categories') }}">
                    <i data-feather="file"></i>
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.categories' ? 'active' : '' }}"><a
                            href="{{ route('admin.categories') }}">
                            <i class="ti-more"></i>All categories</a></li>
                    <li class="{{ $route == 'admin.subcategories' ? 'active' : '' }}"><a
                            href="{{ route('admin.subcategories') }}">
                            <a href="{{ route('admin.subcategories') }}">
                                <i class="ti-more"></i>Subcategory</a></li>
                    <li class="{{ $route == 'admin.subsubcategories' ? 'active' : '' }}"><a
                            href="{{ route('admin.subsubcategories') }}">

                            <i class="ti-more"></i>Sub-Subcategory</a></li>
                </ul>
            </li>
            <li class="treeview {{ $route == 'admin.products' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.add.products' ? 'active' : '' }}">
                        <a href="{{ route('admin.add.products') }}">
                            <i class="ti-more"></i>Add products</a>
                    </li>
                    <li class="{{ $route == 'admin.manage.products' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.products')}}">
                            <i class="ti-more"></i>Manage products</a>
                    </li>

                </ul>
            </li>
            <li class="treeview {{ $route == 'admin.sliders' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Sliders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.manage.sliders' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.sliders') }}">
                            <i class="ti-more"></i>Manage sliders</a>
                    </li>
                    {{-- <li class="{{ $route == 'admin.manage.products' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.products')}}">
                            <i class="ti-more"></i>Manage products</a>
                    </li> --}}

                </ul>
            </li>



            <li class="header nav-small-cap">User Interface</li>

            <li class="treeview {{ $route == 'admin.coupons' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>Coupons</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.manage.coupons' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.coupons') }}"><i class="ti-more"></i>Manage coupons</a>
                        </li>

                </ul>
            </li>

            <li class="treeview {{ $route == 'admin.shipping' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="credit-card"></i>
                    <span>Shipping area</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.manage.division' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.division') }}">
                            <i class="ti-more"></i>Manage division</a>
                    </li>

                </ul>
            </li>




        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
            aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
                class="ti-lock"></i></a>
    </div>
</aside>
