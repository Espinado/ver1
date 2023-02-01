 <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
     <div class="more-info-tab clearfix ">
         <h3 class="new-product-title pull-left">New Products</h3>
         <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">

             <div class="accordion">
                 @php
                     $categories = App\Models\Admins\Category::orderBy('category_name', 'asc')->get();
                 @endphp
                 <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                     <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>

                     @foreach ($categories as $category)
                         <li><a data-transition-type="backSlide" href="#category{{ $category->id }}"
                                 data-toggle="tab">{{ $category->category_name }}</a>
                         </li>
                     @endforeach

                 </ul>


         </ul>
         <!-- /.nav-tabs -->
     </div>
     <div class="tab-content outer-top-xs">
         <div class="tab-pane in active" id="all">
             <div class="product-slider">
                 <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                     @foreach ($products as $product)
                         <div class="item item-carousel">
                             <div class="products">
                                 <div class="product">
                                     <div class="product-image">
                                         <div class="image"> <a
                                                 href="{{ url('/product/details/' . $product->id . '/' . $product->slug) }}"><img
                                                     src="{{ asset($product->product_thambnail) }}" alt=""></a>
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
                                         <h3 class="name"><a
                                                 href="{{ url('/product/details/' . $product->id . '/' . $product->slug) }}">{{ $product->product_name }}</a>
                                         </h3>
                                         <div class="rating rateit-small"></div>
                                         <div class="description"></div>
                                         @if ($product->discount_price == null)
                                             <div class="product-price"> <span class="price">$
                                                     {{ $product->selling_price }}</span>
                                             </div>
                                         @else
                                             <div class="product-price"> <span class="price"> $
                                                     {{ $product->discount_price }}
                                                 </span> <span class="price-before-discount">$
                                                     {{ $product->selling_price }}</span>
                                             </div>
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
             </div>
             <!-- /.product-slider -->
         </div>
         <!-- /.tab-pane -->
         @foreach ($categories as $category)
             <div class="tab-pane" id="category{{ $category->id }}">
                 <div class="product-slider">
                     <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                         @php
                             $catwiseProduct = App\Models\Admins\Product::where('status', true)
                                 ->where('category_id', $category->id)
                                 ->orderBy('id', 'desc')
                                 ->get();
                         @endphp
                         @forelse ($catwiseProduct as $product)
                             <div class="item item-carousel">
                                 <div class="products">
                                     <div class="product">
                                         <div class="product-image">
                                             <div class="image"> <a
                                                     href="{{ url('/product/details/' . $product->id . '/' . $product->slug) }}"><img
                                                         src="{{ asset($product->product_thambnail) }}"
                                                         alt=""></a> </div>
                                             <!-- /.image -->

                                             @if ($product->discount_price == null)
                                                 <div class="tag new"><span>NEW</span></div>
                                             @else
                                                 <div class="tag hot"><span>- {{ $discount }}
                                                         %</span></div>
                                             @endif
                                         </div>
                                         <!-- /.product-image -->

                                         <div class="product-info text-left">
                                             <h3 class="name"><a
                                                     href="{{ url('/product/details/' . $product->id . '/' . $product->slug) }}">{{ $product->product_name }}</a>
                                             </h3>
                                             <div class="rating rateit-small"></div>
                                             <div class="description"></div>
                                             @if ($product->discount_price == null)
                                                 <div class="product-price"> <span class="price">$
                                                         {{ $product->selling_price }}</span>
                                                 </div>
                                             @else
                                                 <div class="product-price"> <span class="price"> $
                                                         {{ $product->discount_price }}
                                                     </span> <span class="price-before-discount">$
                                                         {{ $product->selling_price }}</span>
                                                 </div>
                                             @endif


                                         </div>
                                         <!-- /.product-info -->
                                         @include('customers.sections.products.carts')
                                         <!-- /.cart -->
                                     </div>
                                     <!-- /.product -->

                                 </div>
                                 <!-- /.products -->
                             </div>
                         @empty
                             <h5 class="text-danger">No products</h5>
                         @endforelse
                         <!-- /.item -->


                         <!-- /.item -->
                     </div>
                     <!-- /.home-owl-carousel -->
                 </div>
                 <!-- /.product-slider -->
             </div>
             <!-- /.tab-pane -->
         @endforeach



     </div>
     <!-- /.tab-content -->
 </div>
