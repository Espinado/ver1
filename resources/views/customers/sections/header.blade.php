<!-- ============================================== TOP MENU ============================================== -->
<div class="top-bar animate-dropdown">
    <div class="container">
        <div class="header-top-inner">
            <div class="cnt-account">
                <ul class="list-unstyled">


                    @auth
                    <li onclick="wishlist"><a href="{{ route('wishlist') }}">
                                <i class="icon fa fa-heart"></i>
                                {{ __('system.wishlist') }} <span class="badge badge-danger" id="count_wishes"> </span>
                            </a>
                            </li>
                        @endauth
                        <li><a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>{{ __('system.cart') }}</a></li>
                        <li><a href="{{route('product.checkout')}}"><i class="icon fa fa-check"></i>{{ __('system.checkout') }}</a></li>
                        @auth
                            <li><a href="{{ route('profile.index') }}"><i
                                        class="icon fa fa-user"></i>{{ Auth::user()->name }}</a></li>
                        @else
                            <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>{{ __('system.login/register') }}</a></li>
                        @endauth
                </ul>
                </ul>
            </div>
            <!-- /.cnt-account -->

            <div class="cnt-block">
                <ul class="list-unstyled list-inline">
                    {{-- <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                            data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">USD</a></li>
                            <li><a href="#">INR</a></li>
                            <li><a href="#">GBP</a></li>

                        </ul>
                    </li> --}}
                    <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                            data-toggle="dropdown"><span
                                class="value"><span class="{{LaravelLocalization::getCurrentLocaleIcon()}}"></span>&nbsp;&nbsp;{{ LaravelLocalization::getCurrentLocaleNative() }} </span><b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">

                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    @if (LaravelLocalization::getCurrentLocale() != $localeCode)
                                        <a rel="alternate" hreflang="{{ $localeCode }}"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                           <span class="{{ $properties['icon'] }}"> </span>&nbsp;&nbsp; {{ $properties['native'] }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <!-- /.list-unstyled -->
            </div>
            <!-- /.cnt-cart -->
            <div class="clearfix"></div>
        </div>
        <!-- /.header-top-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.header-top -->

<!-- ============================================== TOP MENU : END ============================================== -->
<div class="main-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                <!-- ============================================================= LOGO ============================================================= -->
                <div class="logo"> <a href="{{ route('index') }}"> <img
                            src="{{ asset('customers/assets/images/logo.png') }}" alt="logo"> </a> </div>
                <!-- /.logo -->
                <!-- ============================================================= LOGO : END ============================================================= -->
            </div>
            <!-- /.logo-holder -->

            <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                <!-- /.contact-row -->
                <!-- ============================================================= SEARCH AREA ============================================================= -->
                @include('customers.sections.search_area')
                <!-- /.search-area -->
                <!-- ============================================================= SEARCH AREA : END ============================================================= -->
            </div>
            <!-- /.top-search-holder -->

            <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                @include('customers.sections.shopping_cart_dropdown')
                <!-- /.dropdown-cart -->

                <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
            </div>
            <!-- /.top-cart-row -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

</div>
<!-- /.main-header -->

<!-- ============================================== NAVBAR ============================================== -->
<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                    class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                    <div class="nav-outer">
                        <ul class="nav navbar-nav">
                            <li class="active dropdown yamm-fw"> <a href="{{ route('index') }}" data-hover="dropdown"
                                    class="dropdown-toggle" data-toggle="dropdown">{{ __('system.home') }}</a> </li>
                            @php
                                $categories = App\Models\Admins\Category::orderBy('category_name', 'asc')->get();
                            @endphp

                            @foreach ($categories as $category)
                                <li class="dropdown yamm mega-menu"> <a href="#" data-hover="dropdown"
                                        class="dropdown-toggle"
                                        data-toggle="dropdown">{{ $category->category_name }}</a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">
                                                    @php
                                                        $subcategories = App\Models\Admins\SubCategory::where('category_id', $category->id)
                                                            ->orderBy('subcategory_name', 'asc')
                                                            ->get();
                                                    @endphp

                                                    @foreach ($subcategories as $subcategory)
                                                        <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                            <a
                                                                href="{{ url('/product/subcategory/' . $subcategory->id . '/' . $subcategory->slug) }}">
                                                                <h2 class="title">{{ $subcategory->subcategory_name }}
                                                                </h2>
                                                            </a>
                                                            @php
                                                                $subsubcategories = App\Models\Admins\SubSubCategory::where('subcategory_id', $subcategory->id)
                                                                    ->orderBy('subsubcategory_name', 'asc')
                                                                    ->get();
                                                            @endphp
                                                            <ul class="links">
                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    <li><a
                                                                            href="{{ url('/product/subsubcategory/' . $subsubcategory->id . '/' . $subsubcategory->slug) }}">{{ $subsubcategory->subsubcategory_name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                    <!-- /.col -->



                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                                        <img class="img-responsive"
                                                            src="{{ asset('customers/assets/images/banners/top-menu-banner.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <!-- /.yamm-content -->
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach

                            <li class="dropdown  navbar-right special-menu"> <a href="#">{{ __('system.today_offer') }}</a> </li>
                        </ul>
                        <!-- /.navbar-nav -->
                        <div class="clearfix"></div>
                    </div>
                    <!-- /.nav-outer -->
                </div>
                <!-- /.navbar-collapse -->

            </div>
            <!-- /.nav-bg-class -->
        </div>
        <!-- /.navbar-default -->
    </div>
    <!-- /.container-class -->

</div>
<!-- /.header-nav -->
<!-- ============================================== NAVBAR : END ============================================== -->
