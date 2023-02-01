 @php
     $newArrivals = App\Models\Admins\Product::orderBy('created_at', 'desc')
         ->limit(10)
         ->get();
 @endphp
 <section class="section wow fadeInUp new-arriavls">
     <h3 class="section-title">New Arrivals</h3>
     <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
         @foreach ($newArrivals as $product)
             <div class="item item-carousel">
                 <div class="products">
                     <div class="product">
                         <div class="product-image">
                             <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->slug) }}"><img src="{{ asset($product->product_thambnail) }}"
                                         alt=""></a> </div>
                             <!-- /.image -->
                             @php
                                 $amount = $product->selling_price - $product->discount_price;
                                 $discount = round(($amount / $product->selling_price) * 100);
                             @endphp
                             @if ($product->discount_price == null)
                                 <div class="tag new"><span>new</span></div>
                             @else
                                 <div class="tag hot"><span>- {{ $discount }} % </span></div>
                             @endif

                         </div>
                         <!-- /.product-image -->

                         <div class="product-info text-left">
                             <h3 class="name"><a href="detail.html">{{ $product->product_name }}</a></h3>
                             <div class="rating rateit-small"></div>
                             <div class="description"></div>
                            @if ($product->discount_price == null)
                              <div class="product-price"> <span class="price"> $ {{ $product->selling_price }} </span>
                              </div>
                          @else
                              <div class="product-price"> <span class="price"> $ {{ $product->discount_price }} </span>
                                  <span class="price-before-discount">$ {{ $product->selling_price }}</span> </div>
                              <!-- /.product-price -->
                          @endif
                             <!-- /.product-price -->

                         </div>
                         <!-- /.product-info -->
                        @include('customers.sections.products.carts')
                         <!-- /.cart -->
                     </div>
                     <!-- /.product -->

                 </div>
                 <!-- /.products -->
             </div>
         @endforeach
         <!-- /.item -->


         <!-- /.item -->
     </div>
     <!-- /.home-owl-carousel -->
 </section>
