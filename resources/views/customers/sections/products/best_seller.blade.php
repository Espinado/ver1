 <div class="best-deal wow fadeInUp outer-bottom-xs">
     @php
         use App\Models\Customers\OrderItem;
         $bestSellers = OrderItem::select('product_id', \DB::raw('SUM(qty) as total_qty'))
             ->groupBy('product_id')
             ->orderByDesc('total_qty')
             ->with('product')
             ->get();
         //  dd($bestSellers);
     @endphp
     <h3 class="section-title">Best seller</h3>
     <div class="sidebar-widget-body outer-top-xs">
         <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">

             @foreach ($bestSellers as $best)
                 <div class="item">
                     <div class="products best-product">
                         <div class="product">
                             <div class="product-micro">
                                 <div class="row product-micro-row">
                                     <div class="col col-xs-5">
                                         <div class="product-image">
                                             <div class="image"> <a
                                                     href="{{ url('/product/details/' . $best['product']['id'] . '/' . $best['product']['slug']) }}">
                                                     <img src="{{ asset($best['product']['product_thambnail']) }}"
                                                         alt=""> </a> </div>
                                             <!-- /.image -->

                                         </div>
                                         <!-- /.product-image -->
                                     </div>
                                     <!-- /.col -->
                                     <div class="col2 col-xs-7">
                                         <div class="product-info">
                                             <h3 class="name"><a
                                                     href="{{ url('/product/details/' . $best['product']['id'] . '/' . $best['product']['slug']) }}">{{ $best['product']['product_name'] }}</a>
                                             </h3>
                                             @if ($best['product']['discount_price'] == null)
                                                 <div class="product-price"> <span class="price"> EUR
                                                         {{ $best['product']['selling_price'] }}
                                                     </span></div>
                                             @else
                                                 <div class="product-price"> <span class="price"> EUR
                                                         {{ $best['product']['discount_price'] }}
                                                     </span> <span class="price-before-discount">EUR
                                                         {{ $best['product']['selling_price'] }}</span>
                                                 </div>
                                                 <!-- /.product-price -->
                                             @endif
                                             Sold:{{ $best->total_qty }}

                                         </div>
                                     </div>
                                     <!-- /.col -->
                                 </div>
                                 <!-- /.product-micro-row -->
                             </div>
                             <!-- /.product-micro -->

                         </div>

                     </div>
                 </div>
             @endforeach


         </div>
     </div>
     <!-- /.sidebar-widget-body -->
 </div>
