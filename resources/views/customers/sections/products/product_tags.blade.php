{{-- @php
    $productTags = App\Models\Admins\Product::groupBy('product_tags')
        ->select('product_tags')
        ->get();

@endphp
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">{{ __('system.product_tags') }}</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @foreach ($productTags as $tag)
          <a class="item active" title="{{ str_replace(',',' ',$tag->product_tags)  }}" href="{{url('product/tag/'.$tag->product_tags)}}">
	{{ str_replace(',',' ',$tag->product_tags)  }}</a>
            @endforeach

        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div> --}}

@php
    $special_offer = App\Models\Admins\Product::where('special_offer', 1)
        ->where('status', true)
        ->orderBy('id', 'DESC')
        ->limit(3)
        ->get();
@endphp
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">{{ __('system.special_offer') }}</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
            <div class="item">
                <div class="products special-product">
                    @foreach ($special_offer as $product)
                        <div class="product">
                            <div class="product-micro">
                                <div class="row product-micro-row">
                                    <div class="col col-xs-5">
                                        <div class="product-image">
                                            <div class="image"> <a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->slug) }}">
                                                    <img src="{{ asset($product->product_thambnail) }}" alt="">
                                                </a> </div>
                                            <!-- /.image -->

                                        </div>
                                        <!-- /.product-image -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col col-xs-7">
                                        <div class="product-info">
                                            <h3 class="name"><a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->slug) }}">
                                                    {{ $product->product_name }} </a></h3>
                                            {{-- <div class="rating rateit-small"></div> --}}
                                              @if ($product->discount_price == null)
                                                                <div class="product-price"> <span class="price">EUR
                                                                        {{ $product->selling_price }}</span>
                                                                </div>
                                                            @else
                                                                <div class="product-price"> <span class="price"> EUR
                                                                        {{ $product->discount_price }}
                                                                    </span> <span class="price-before-discount">EUR
                                                                        {{ $product->selling_price }}</span>
                                                                </div>
                                                            @endif

                                            <!-- /.product-price -->

                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.product-micro-row -->
                            </div>
                            <!-- /.product-micro -->

                        </div>
                    @endforeach <!-- // end special offer foreach -->

                </div>
            </div>


        </div>
    </div>
    <!-- /.sidebar-widget-body -->
</div>

