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
                    <span>{{ __('system.dashboard') }}</span>
                </a>
            </li>

            <li class="treeview {{ $route == 'admin.brands' ? 'active' : '' }}">
                <a href="{{ route('admin.brands') }}">
                    <i data-feather="message-circle"></i>
                    <span>{{ __('system.brands') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.brands' ? 'active' : '' }}"><a href="{{ route('admin.brands') }}"><i
                                class="ti-more"></i>{{ __('system.all_brands') }}</a></li>

                </ul>
            </li>

            <li class="treeview {{ $route == 'admin.categories' ? 'active' : '' }}">
                <a href="{{ route('admin.categories') }}">
                    <i data-feather="file"></i>
                    <span>{{ __('system.categories') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.categories' ? 'active' : '' }}"><a
                            href="{{ route('admin.categories') }}">
                            <i class="ti-more"></i>{{ __('system.all_categories') }}</a></li>
                    <li class="{{ $route == 'admin.subcategories' ? 'active' : '' }}"><a
                            href="{{ route('admin.subcategories') }}">
                            <a href="{{ route('admin.subcategories') }}">
                                <i class="ti-more"></i>{{ __('system.subsubcategories') }}</a></li>
                    <li class="{{ $route == 'admin.subsubcategories' ? 'active' : '' }}"><a
                            href="{{ route('admin.subsubcategories') }}">

                            <i class="ti-more"></i>{{ __('system.subsubcategories') }}</a></li>
                </ul>
            </li>
            <li class="treeview {{ $route == 'admin.products' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>{{ __('system.products') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.add.products' ? 'active' : '' }}">
                        <a href="{{ route('admin.add.products') }}">
                            <i class="ti-more"></i>{{ __('system.add_product') }}</a>
                    </li>
                    <li class="{{ $route == 'admin.manage.products' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.products') }}">
                            <i class="ti-more"></i>{{ __('system.manage_products') }}</a>
                    </li>

                </ul>
            </li>
            <li class="treeview {{ $route == 'admin.sliders' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>{{ __('system.sliders') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.manage.sliders' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.sliders') }}">
                            <i class="ti-more"></i>{{ __('system.manage_sliders') }}</a>
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
                    <span>{{ __('system.coupons') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.manage.coupons' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.coupons') }}"><i class="ti-more"></i>{{ __('system.manage_coupons') }}</a>
                    </li>

                </ul>
            </li>

            <li class="treeview {{ $route == 'admin.shipping' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="credit-card"></i>
                    <span>{{ __('system.shipping_area') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.manage.division' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.division') }}">
                            <i class="ti-more"></i>{{ __('system.manage_division') }}</a>
                    </li>
                    <li class="{{ $route == 'admin.manage.ship_district' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.ship_district') }}">
                            <i class="ti-more"></i>Ship district</a>
                    </li>
                    <li class="{{ $route == 'admin.manage.ship_state' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.ship_state') }}">
                            <i class="ti-more"></i>Ship state</a>
                    </li>

                </ul>
            </li>

            <li class="header nav-small-cap">{{ __('system.blogs') }}</li>

            <li class="treeview {{ $route == 'admin.manage.blogs' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="credit-card"></i>
                    <span>{{ __('system.blogs') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.manage.blogs' ? 'active' : '' }}">
                        <a href="{{ route('admin.manage.blogs') }}">
                            <i class="ti-more"></i>{{ __('system.blogs') }}</a>
                    </li>
                    <li class="{{ $route == 'admin.add.blog' ? 'active' : '' }}">
                        <a href="{{ route('admin.add.blog') }}">
                            <i class="ti-more"></i>{{ __('system.add_blog') }}</a>
                    </li>


                </ul>
            </li>
            <li class="header nav-small-cap">{{ __('system.orders') }}</li>

            <li class="treeview {{ $route == 'admin.pending.orders' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>{{ __('system.orders') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.pending.orders' ? 'active' : '' }}">
                        <a href="{{ route('admin.pending.orders') }}"><i class="ti-more"></i>{{ __('system.pending_orders') }}</a>
                    </li>

                </ul>
            </li>







        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
