@extends('customers.layouts.app')
@section('content')
@section('content')
@section('title')
Arguss`s shop
@endsection
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="row">
                <!-- ============================================== SIDEBAR ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                    <!-- ================================== TOP NAVIGATION ================================== -->
                    <div class="side-menu animate-dropdown outer-bottom-xs">
                        <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
                        <nav class="yamm megamenu-horizontal">
                            <ul class="nav">
                                @php
                                    $categories = App\Models\Admins\Category::orderBy('category_name', 'asc')->get();
                                @endphp

                                @foreach ($categories as $category)
                                    <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle"
                                            data-toggle="dropdown"><i class="icon fa fa-shopping-bag"
                                                aria-hidden="true"></i>{{ $category->category_name }}</a>
                                        <ul class="dropdown-menu mega-menu">
                                            <li class="yamm-content">
                                                <div class="row">
                                                    @php
                                                        $subcategories = App\Models\Admins\SubCategory::where('category_id', $category->id)
                                                            ->orderBy('subcategory_name', 'asc')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($subcategories as $subcategory)
                                                        <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                            <h2 class="title">{{ $subcategory->subcategory_name }}</h2>
                                                            @php
                                                                $subsubcategories = App\Models\Admins\SubSubCategory::where('subcategory_id', $category->id)
                                                                    ->orderBy('subsubcategory_name', 'asc')
                                                                    ->get();
                                                            @endphp
                                                            <ul class="links">
                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    <li><a
                                                                            href="#">{{ $subsubcategory->subsubcategory_name }}</a>
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
                                                <!-- /.row -->
                                            </li>
                                            <!-- /.yamm-content -->
                                        </ul>
                                        <!-- /.dropdown-menu -->
                                    </li>
                                @endforeach
                                <!-- /.menu-item -->


                                <!-- /.menu-item -->


                            </ul>
                            <!-- /.nav -->
                        </nav>
                        <!-- /.megamenu-horizontal -->
                    </div>
                    <!-- /.side-menu -->
                    <!-- ================================== TOP NAVIGATION : END ================================== -->

                    <!-- ============================================== HOT DEALS ============================================== -->
                    @include('customers.sections.products.hot_deals')
                    <!-- ============================================== HOT DEALS: END ============================================== -->

                    <!-- ============================================== SPECIAL OFFER ============================================== -->
                    @include('customers.sections.products.special_offer')

                    <!-- /.sidebar-widget -->
                    <!-- ============================================== SPECIAL OFFER : END ============================================== -->
                    <!-- ============================================== PRODUCT TAGS ============================================== -->
                    <div class="sidebar-widget product-tag wow fadeInUp">
                        <h3 class="section-title">Product tags</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="tag-list"> <a class="item" title="Phone" href="category.html">Phone</a>
                                <a class="item active" title="Vest" href="category.html">Vest</a>
                                <a class="item" title="Smartphone" href="category.html">Smartphone</a>
                                <a class="item" title="Furniture" href="category.html">Furniture</a>
                                <a class="item" title="T-shirt" href="category.html">T-shirt</a>
                                <a class="item" title="Sweatpants" href="category.html">Sweatpants</a> <a class="item"
                                    title="Sneaker" href="category.html">Sneaker</a> <a class="item" title="Toys"
                                    href="category.html">Toys</a> <a class="item" title="Rose"
                                    href="category.html">Rose</a>
                            </div>
                            <!-- /.tag-list -->
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                    <!-- ============================================== SPECIAL DEALS ============================================== -->
                    @include('customers.sections.products.special_deals')

                    <!-- /.sidebar-widget -->
                    <!-- ============================================== SPECIAL DEALS : END ============================================== -->
                    <!-- ============================================== NEWSLETTER ============================================== -->
                    @include('customers.sections.newsletter')
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== NEWSLETTER: END ============================================== -->

                    <!-- ============================================== Testimonials============================================== -->
                    @include('customers.sections.testimonials')
                    <!-- ============================================== Testimonials: END ============================================== -->

                    <div class="home-banner"> <img src="{{ asset('customers/assets/images/banners/LHS-banner.jpg') }}"
                            alt="Image">
                    </div>
                </div>
                <!-- /.sidemenu-holder -->
                <!-- ============================================== SIDEBAR : END ============================================== -->

                <!-- ============================================== CONTENT ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                    <!-- ========================================== SECTION – HERO ========================================= -->

                    <div id="hero">
                        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                            @php
                                $sliders = App\Models\Admins\Slider::where('status', 1)
                                    ->orderBy('id', 'desc')
                                    ->get();
                            @endphp
                            @foreach ($sliders as $slider)
                                <div class="item" style="background-image: url({{ asset($slider->slider_img) }});">
                                    <div class="container-fluid">
                                        <div class="caption bg-color vertical-center text-left">
                                            <div class="slider-header fadeInDown-1">Top Brands</div>
                                            <div class="big-text fadeInDown-1">{{ $slider->title }} </div>
                                            <div class="excerpt fadeInDown-2 hidden-xs">
                                                <span>{{ $slider->description }}<span>
                                            </div>
                                            <div class="button-holder fadeInDown-3"> <a href="index.php?page=single-product"
                                                    class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop
                                                    Now</a> </div>
                                        </div>
                                        <!-- /.caption -->
                                    </div>
                                    <!-- /.container-fluid -->
                                </div>
                                <!-- /.item -->
                            @endforeach


                            <!-- /.item -->

                        </div>
                        <!-- /.owl-carousel -->
                    </div>

                    <!-- ========================================= SECTION – HERO : END ========================================= -->

                    <!-- ============================================== INFO BOXES ============================================== -->
                    <div class="info-boxes wow fadeInUp">
                        <div class="info-boxes-inner">
                            <div class="row">
                                <div class="col-md-6 col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">money back</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">30 Days Money Back Guarantee</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="hidden-md col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">free shipping</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Shipping on orders over $99</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-md-6 col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">Special Sale</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Extra $5 off on all items </h6>
                                    </div>
                                </div>
                                <!-- .col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.info-boxes-inner -->

                    </div>
                    <!-- /.info-boxes -->
                    <!-- ============================================== INFO BOXES : END ============================================== -->
                    <!-- ============================================== SCROLL TABS ============================================== -->
                    @include('customers.sections.products.new_products')
                    <!-- /.scroll-tabs -->
                    <!-- ============================================== SCROLL TABS : END ============================================== -->
                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners wow fadeInUp outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-7 col-sm-7">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('customers/assets/images/banners/home-banner1.jpg') }}"
                                            alt=""> </div>
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-5 col-sm-5">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('customers/assets/images/banners/home-banner2.jpg') }}"
                                            alt=""> </div>
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->

                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    @include('customers.sections.products.featured_products')
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners wow fadeInUp outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('customers/assets/images/banners/home-banner.jpg') }}"
                                            alt=""> </div>
                                    <div class="strip strip-text">
                                        <div class="strip-inner">
                                            <h2 class="text-right">New Mens Fashion<br>
                                                <span class="shopping-needs">Save up to 40% off</span>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="new-label">
                                        <div class="text">NEW</div>
                                    </div>
                                    <!-- /.new-label -->
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->
                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                    <!-- ============================================== BEST SELLER ============================================== -->
                    @include('customers.sections.products.best_seller')

                    <!-- /.sidebar-widget -->
                    <!-- ============================================== BEST SELLER : END ============================================== -->

                    <!-- ============================================== BLOG SLIDER ============================================== -->
                    @include('customers.sections.blog')
                    <!-- /.section -->
                    <!-- ============================================== BLOG SLIDER : END ============================================== -->

                    <!-- ============================================== New arrivals ============================================== -->
                    @include('customers.sections.products.new_arrivals')
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

                </div>
                <!-- /.homebanner-holder -->
                <!-- ============================================== CONTENT : END ============================================== -->
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('customers.sections.brands')

            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /#top-banner-and-menu -->
@endsection
