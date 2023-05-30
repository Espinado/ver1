@extends('customers.layouts.app')
@section('content')
@section('title')
    {{ $product->product_name }}
@endsection
<link rel="stylesheet" href="{{ asset('customers/assets/css/bootstrap.min.css') }}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{ asset('customers/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('customers/assets/css/blue.css') }}">
<link rel="stylesheet" href="{{ asset('customers/assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('customers/assets/css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ asset('customers/assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('customers/assets/css/rateit.css') }}">
<link rel="stylesheet" href="{{ asset('customers/assets/css/bootstrap-select.min.css') }}">
<link href="{{ asset('customers/assets/css/lightbox.css') }}" rel="stylesheet">
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{route('index')}}">Home</a></li>
                <li><a href="#">{{$product['category']['category_name']}}</a></li>
                @if($product['subcategory'])
                <li><a href="#">{{$product['subcategory']['subcategory_name']}}</a></li>
                @endif
                <li class='active'>{{$product->product_name}}</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-3 sidebar'>
                <div class="sidebar-module-container">
                    {{-- <div class="home-banner outer-top-n">
                        <img src="{{ asset('customers/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                    </div> --}}

                    <!-- ================================== TOP NAVIGATION ================================== -->
                    @include('customers.sections.top_navigation')
                    <!-- ================================== TOP NAVIGATION : END ================================== -->

                    <!-- ============================================== HOT DEALS ============================================== -->
                    @include('customers.sections.products.hot_deals')
                    <!-- ============================================== HOT DEALS: END ============================================== -->

                    <!-- ============================================== NEWSLETTER ============================================== -->
                    @include('customers.sections.newsletter')
                    <!-- ============================================== NEWSLETTER: END ============================================== -->

                    <!-- ============================================== Testimonials============================================== -->
                    @include('customers.sections.testimonials')

                    <!-- ============================================== Testimonials: END ============================================== -->



                </div>
            </div><!-- /.sidebar -->
            <div class='col-md-9'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    @foreach ($images as $image)
                                        <div class="single-product-gallery-item" id="slide{{ $image->id }}">
                                            <a data-lightbox="image-{{ $image->id }}" data-title="Gallery"
                                                href="{{ asset($image->photo_name) }}">
                                                <img class="img-responsive" alt=""
                                                    src="{{ asset($image->photo_name) }}"
                                                    data-echo="{{ asset($image->photo_name) }}" />
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->
                                    @endforeach



                                </div><!-- /.single-product-slider -->


                                <div class="single-product-gallery-thumbs gallery-thumbs">

                                    <div id="owl-single-product-thumbnails">
                                        @foreach ($images as $image)
                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                    data-slide="{{ $image->id }}" href="#slide{{ $image->id }}">
                                                    <img class="img-responsive" width="85" alt=""
                                                        src="{{ asset($image->photo_name) }}"
                                                        data-echo="{{ asset($image->photo_name) }}" />
                                                </a>
                                            </div>
                                        @endforeach

                                    </div><!-- /#owl-single-product-thumbnails -->



                                </div><!-- /.gallery-thumbs -->

                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name" id="pname">{{ $product->product_name }}</h1>

                                {{-- <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="rating rateit-small"></div>
                                        </div>

                                    </div><!-- /.row -->
                                </div><!-- /.rating-reviews --> --}}

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">{{ __('system.available') }} :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">{{ $product->product_qty }}&nbsp; {{ __('system.pieces') }}</span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->

                                <div class="description-container m-t-20">
                                  {!!$product->short_description!!}
                                </div><!-- /.description-container -->

                                <div class="price-container info-container m-t-20">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                @if ($product->discount_price == null)
                                                    <span class="price">EUR {{ $product->selling_price }}</span>
                                                @else
                                                    <span class="price">EUR {{ $product->discount_price }}</span>
                                                    <span class="price-strike">EUR {{ $product->selling_price }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                {{-- <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="Wishlist" href="#">
                                                    <i class="fa fa-heart"></i>
                                                </a> --}}
                                                {{-- <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="Add to Compare" href="#">
                                                    <i class="fa fa-signal"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip"
                                                    data-placement="right" title="E-mail" href="#">
                                                    <i class="fa fa-envelope"></i>
                                                </a> --}}
                                            </div>
                                        </div>

                                    </div><!-- /.row -->

                                    <div class="row">
                                        {{-- <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="info-title control-label">{{ __('system.choose_color') }}
                                                    <span>*</span></label>
                                                <select class="form-control unicase-form-control selectpicker"
                                                    style="display: none;" id="color">
                                                    <option  value="">--{{ __('system.choose_color') }}--</option>
                                                    @foreach ($product_colors as $color)
                                                        <option value="{{ $color }}">{{ ucwords($color) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="col-sm-6">
                                            <div class="form-group">
                                                @if ($product->product_size == null)
                                                @else
                                                    <label class="info-title control-label">{{ __('system.choose_size') }}
                                                        <span>*</span></label>
                                                    <select class="form-control unicase-form-control selectpicker"
                                                        style="display: none;" id="size">
                                                        <option >--{{ __('system.choose_size') }}--</option>
                                                        @foreach ($product_size as $size)
                                                            <option value="{{ $size }}">{{ ucwords($size) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>

                                        </div> --}}

                                    </div><!-- /.row -->

                                </div><!-- /.price-container -->

                                <div class="quantity-container info-container">
                                    <div class="row">

                                        {{-- <div class="col-sm-2">
                                            <span class="label">{{ __('system.qty') }} :</span>
                                        </div> --}}

                                        <div class="col-sm-2">
                                            {{-- <div class="cart-quantity">
                                                <div class="quant-input">
                                                    <div class="arrows"> --}}
                                                        {{-- <div class="arrow plus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-asc"></i></span></div>
                                                        <div class="arrow minus gradient"><span class="ir"><i
                                                                    {{-- class="icon fa fa-sort-desc"></i></span></div> --}}
                                                    {{-- </div> --}}
                                                    {{-- <input type="number" id="qty" value="1"
                                                        min="1">
                                                </div>
                                            </div> --}}
                                        </div>
                                        <input type="hidden" name="id" id="product_id"
                                            value="{{ $product->id }}">"
                                        <div class="col-sm-7">
                                            <button type="submit" onclick="productView(this.id)" class="btn btn-primary" data-toggle="modal"
                                      data-target="#exampleModal" id="{{ $product->id }}">
                                                <i class="fa fa-shopping-cart inner-right-vs"></i>{{ __('system.add_to_cart') }}</button>


                                        </div>



                                    </div><!-- /.row -->
                                </div><!-- /.quantity-container -->






                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                </div>

                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">{{ __('system.description') }}</a></li>

                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">

                            <div class="tab-content">

                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text">{!!$product->long_description!!}</p>
                                    </div>
                                </div><!-- /.tab-pane -->




                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->

                <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    @if ($related_products->isEmpty())
                        <h1 style="text-align: center"><span class="text-danger">{{ __('system.no_related_products_found') }}</span></h1>
                    @endif
                    <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                        @foreach ($related_products as $related_product)
                            <div class="item item-carousel">
                                <div class="products">

                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.html"><img
                                                        src="{{ asset($related_product->product_thambnail) }}"
                                                        alt=""></a>
                                            </div><!-- /.image -->

                                            <div class="tag hot"><span>{{ __('system.sale') }}</span></div>
                                        </div><!-- /.product-image -->


                                        <div class="product-info text-left">
                                            <h3 class="name"><a
                                                    href="detail.html">{{ $related_product->product_name }}</a></h3>
                                            {{-- <div class="rating rateit-small"></div> --}}
                                            <div class="description"></div>

                                            <div class="product-price">
                                                @if ($product->discount_price == null)
                                                    <span class="price">EUR {{ $product->selling_price }}</span>
                                                @else
                                                    <span class="price">EUR {{ $product->discount_price }}</span>
                                                    <span class="price-before-discount">EUR {{ $product->selling_price }}</span>
                                                @endif

                                            </div><!-- /.product-price -->

                                        </div><!-- /.product-info -->
                                        @include('customers.sections.products.carts')<!-- /.cart -->
                                    </div><!-- /.product -->

                                </div><!-- /.products -->
                            </div><!-- /.item -->
                        @endforeach


                    </div><!-- /.home-owl-carousel -->

                </section><!-- /.section -->
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

            </div><!-- /.col -->
            <div class="clearfix"></div>
        </div><!-- /.row -->






        <!-- ==== ================== BRANDS CAROUSEL ============================================== -->
        @include('customers.sections.brands')
        <!-- == = BRANDS CAROUSEL : END = -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection
