 <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown" onclick="miniCart()">
         <div class="items-cart-inner">
             <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
             <div class="basket-item-count"><span class="count" id="cartQty"> </span></div>
              <div class="total-price-basket"> <span class="lbl">cart -</span>
                <span class="total-price"> <span class="sign">$</span>
                <span class="value" id="cartSubTotal"> </span> </span> </div>
         </div>
     </a>
     <ul class="dropdown-menu">
         <li>
            <div id="miniCart">

         </div>
             <!-- /.cart-item -->
             <div class="clearfix"></div>
             <hr>
             <div class="clearfix cart-total">
              <div class="pull-right"> <span class="text">Sub Total :</span>
                    <span class='price'  id="cartSubTotal"> </span> </div>
                 <div class="clearfix"></div>
                 <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
             </div>
             <!-- /.cart-total-->

         </li>
     </ul>
     <!-- /.dropdown-menu-->
 </div>
