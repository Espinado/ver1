 @php
     $newArrivals = App\Models\Admins\Product::orderBy('created_at', 'desc')
         ->limit(10)
         ->get();
 @endphp
 <section class="section wow fadeInUp new-arriavls">
     <h3 class="section-title">New Arrivals</h3>
     <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
         @foreach ($newArrivals as $new)
             <div class="item item-carousel">
                 <div class="products">
                     <div class="product">
                         <div class="product-image">
                             <div class="image"> <a href="detail.html"><img src="{{ asset($new->product_thambnail) }}"
                                         alt=""></a> </div>
                             <!-- /.image -->
                             @php
                                 $amount = $new->selling_price - $new->discount_price;
                                 $discount = round(($amount / $new->selling_price) * 100);
                             @endphp
                             @if ($new->discount_price == null)
                                 <div class="tag new"><span>new</span></div>
                             @else
                                 <div class="tag hot"><span>- {{ $discount }} % </span></div>
                             @endif

                         </div>
                         <!-- /.product-image -->

                         <div class="product-info text-left">
                             <h3 class="name"><a href="detail.html">{{ $new->product_name }}</a></h3>
                             <div class="rating rateit-small"></div>
                             <div class="description"></div>
                            @if ($new->discount_price == null)
                              <div class="product-price"> <span class="price"> $ {{ $new->selling_price }} </span>
                              </div>
                          @else
                              <div class="product-price"> <span class="price"> $ {{ $new->discount_price }} </span>
                                  <span class="price-before-discount">$ {{ $new->selling_price }}</span> </div>
                              <!-- /.product-price -->
                          @endif
                             <!-- /.product-price -->

                         </div>
                         <!-- /.product-info -->
                         <div class="cart clearfix animate-effect">
                             <div class="action">
                                 <ul class="list-unstyled">
                                     <li class="add-cart-button btn-group">
                                         <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i
                                                 class="fa fa-shopping-cart"></i> </button>
                                         <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                     </li>
                                     <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                             title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                     <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i
                                                 class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                 </ul>
                             </div>
                             <!-- /.action -->
                         </div>
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
