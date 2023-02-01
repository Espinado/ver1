@php
    $special_offer = App\Models\Admins\Product::where('special_offer', 1)
        ->where('status', true)
        ->orderBy('id', 'DESC')
        ->limit(3)
        ->get();
@endphp
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">Special Offer</h3>
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
                                            <div class="rating rateit-small"></div>
                                            <div class="product-price"> <span class="price">
                                                    ${{ $product->selling_price }} </span> </div>
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
