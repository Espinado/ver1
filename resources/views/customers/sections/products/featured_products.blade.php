 <section class="featured spad">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="section-title">
                     <h2>Featured Product</h2>
                 </div>
                 <div class="featured__controls">
                     <ul>
                         <li class="active" data-filter="*">All</li>
                         @foreach ($categories as $category)
                             @foreach (json_decode($category->category_name, true) as $key => $catItem)
                              @if(!isset($category->parent_id))
                                 @if ($key == LaravelLocalization::GetCurrentLocale())
                                     <li data-filter=".{{ $catItem }}">{{ $catItem }}</li>
                                 @endif
                                 @endif
                             @endforeach
                         @endforeach


                     </ul>
                 </div>
             </div>
         </div>
         <div class="row featured__filter">
             @foreach ($products as $product)
                 <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">

                     <div class="featured__item">

                         @foreach (json_decode($product->images) as $key => $image)
                             <div class="featured__item__pic set-bg" data-setbg="{{ asset('products/' . [$image][0]) }}"
                                 width="20" height="20">
                                 <ul class="featured__item__pic__hover">
                                     <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                     <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                     <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                 </ul>
                             </div>
                         @endforeach

                         <div class="featured__item__text">
                             <h6><a href="#">
                                     @foreach (json_decode($product->product_name, true) as $key => $prod)
                                         @if ($key == LaravelLocalization::GetCurrentLocale())
                                             {{-- @if (in_array($key, LaravelLocalization::getSupportedLanguagesKeys())) --}}
                                             {{ $prod }}
                                         @endif
                                 </a></h6>
             @endforeach
             <h5>$ {{ $product->selling_price }}</h5>
         </div>
     </div>
     </div>
     @endforeach


     </div>
     </div>
 </section>
