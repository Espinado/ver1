    @php
        $special_deals = App\Models\Admins\Product::where('special_deals', 1)
            ->where('status', true)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
    @endphp
    <div class="sidebar-widget outer-bottom-small wow fadeInUp">
        <h3 class="section-title">Special Deals</h3>
        <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                <div class="item">
                    <div class="products special-product">
                        @foreach ($special_deals as $deal)
                            <div class="product">
                                <div class="product-micro">
                                    <div class="row product-micro-row">
                                        <div class="col col-xs-5">
                                            <div class="product-image">
                                                <div class="image"> <a
                                                        href="{{ url('/product/details/' . $deal->id . '/' . $deal->slug) }}">
                                                        <img src="{{ asset($deal->product_thambnail) }}" alt="">
                                                    </a> </div>
                                                <!-- /.image -->

                                            </div>
                                            <!-- /.product-image -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col col-xs-7">
                                            <div class="product-info">
                                                <h3 class="name"><a href="#">{{$deal->product_name}}</a></h3>
                                                {{-- <div class="rating rateit-small"></div> --}}
                                                @if ($deal->discount_price == null)
                                                                <div class="product-price"> <span class="price">EUR
                                                                        {{ $deal->selling_price }}</span>
                                                                </div>
                                                            @else
                                                                <div class="product-price"> <span class="price"> EUR
                                                                        {{ $deal->discount_price }}
                                                                    </span> <span class="price-before-discount">EUR
                                                                        {{ $deal->selling_price }}</span>
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
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
        <!-- /.sidebar-widget-body -->
    </div>
