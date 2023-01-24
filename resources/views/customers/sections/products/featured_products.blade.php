 <section class="section featured-product wow fadeInUp">
     <h3 class="section-title">Featured products</h3>
     <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

         <!-- /.item -->
         @php
             $products = App\Models\Admins\Product::where('featured', true)
                 ->where('status', true)
                 ->get();
         @endphp
         @foreach ($products as $product)
             <div class="item item-carousel">
                 <div class="products">
                     <div class="product">
                         <div class="product-image">
                             <div class="image"> <a href="{{ url('/product/details/' . $product->id . '/' . $product->slug) }}"><img src="{{ asset($product->product_thambnail) }}"
                                         alt=""></a>
                             </div>
                             <!-- /.image -->

                             @php
                                 $amount = $product->selling_price - $product->discount_price;
                                 $discount = round(($amount / $product->selling_price) * 100);
                             @endphp
                             @if ($product->discount_price == null)
                                 <div class="tag new"><span>NEW</span></div>
                             @else
                                 <div class="tag hot"><span>-{{ $discount }} %</span>
                                 </div>
                             @endif

                         </div>
                         <!-- /.product-image -->

                         <div class="product-info text-left">
                             <h3 class="name"><a href="{{ url('/product/details/' . $product->id . '/' . $product->slug) }}">{{ $product->product_name }}</a></h3>
                             <div class="rating rateit-small"></div>
                             <div class="description"></div>
                             @if ($product->discount_price == null)
                                 <div class="product-price"> <span class="price"> $ {{ $product->selling_price }}
                                     </span></div>
                             @else
                                 <div class="product-price"> <span class="price"> $ {{ $product->discount_price }}
                                     </span> <span class="price-before-discount">$ {{ $product->selling_price }}</span>
                                 </div>
                                 <!-- /.product-price -->
                             @endif

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
                                     <li class="lnk wishlist"> <a class="add-to-cart"
                                             href="{{ url('/product/details/' . $product->id . '/' . $product->slug) }}"
                                             title="Wishlist">
                                             <i class="icon fa fa-heart"></i> </a> </li>
                                     <li class="lnk"> <a class="add-to-cart"
                                             href="{{ url('/product/details/' . $product->id . '/' . $product->slug) }}"
                                             title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
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
