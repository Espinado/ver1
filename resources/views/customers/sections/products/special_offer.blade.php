@php
    $special_offer = App\Models\Admins\Product::where('special_offer', 1)
        ->where('status', true)
        ->orderBy('id', 'DESC')
        ->limit(3)
        ->get();
@endphp
 <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">

      <h3 class="section-title">Special offer</h3>
      <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
          @foreach ($products as $product)
              <div class="item">
                  <div class="products">
                      <div class="hot-deal-wrapper">
                          <div class="image">
                              <a href="{{ url('/product/details/' . $product->id . '/' . $product->slug) }}">
                                  <img src="{{ asset($product->product_thambnail) }}" alt=""></a>
                          </div>
                          @php
                              $amount = $product->selling_price - $product->discount_price;
                              $discount = round(($amount / $product->selling_price) * 100);
                          @endphp
                          @if ($product->discount_price == null)
                              <div class="sale-offer-tag"><span>{{ __('system.new') }}</span></div>
                          @else
                              <div class="sale-offer-tag"><span>{{ $discount }} %<br>
                                      {{ __('system.off') }}</span></div>
                          @endif


                          {{-- <div class="timing-wrapper">
                              <div class="box-wrapper">
                                  <div class="date box"> <span class="key">120</span> <span
                                          class="value">DAYS</span> </div>
                              </div>
                              <div class="box-wrapper">
                                  <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span>
                                  </div>
                              </div>
                              <div class="box-wrapper">
                                  <div class="minutes box"> <span class="key">36</span> <span
                                          class="value">MINS</span> </div>
                              </div>
                              <div class="box-wrapper hidden-md">
                                  <div class="seconds box"> <span class="key">60</span> <span
                                          class="value">SEC</span> </div>
                              </div>
                          </div> --}}
                      </div>
                      <!-- /.hot-deal-wrapper -->

                      <div class="product-info text-left m-t-20">
                          <h3 class="name"><a
                                  href="{{ url('/product/details/' . $product->id . '/' . $product->slug) }}">{{ $product->product_name }}</a>
                          </h3>
                          {{-- <div class="rating rateit-small"></div> --}}
                          @if ($product->discount_price == null)
                              <div class="product-price"> <span class="price"> EUR {{ $product->selling_price }} </span>
                              </div>
                          @else
                              <div class="product-price"> <span class="price">EUR {{ $product->discount_price }} </span>
                                  <span class="price-before-discount">EUR {{ $product->selling_price }}</span>
                              </div>
                              <!-- /.product-price -->
                          @endif
                      </div>


                      <!-- /.product-info -->

                      <div class="cart clearfix animate-effect">
                          <div class="action">
                              <div class="add-cart-button btn-group">
                                  {{-- <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                      <i class="fa fa-shopping-cart"></i> </button> --}}
                                  <button class="btn btn-primary cart-btn" data-toggle="modal"
                                      data-target="#exampleModal" id="{{ $product->id }}"
                                      onclick="productView(this.id)">{{ __('system.add_to_cart') }}</button>
                              </div>
                          </div>
                          <!-- /.action -->
                      </div>
                      <!-- /.cart -->
                  </div>
              </div>
          @endforeach

      </div>
      <!-- /.sidebar-widget -->
  </div>
