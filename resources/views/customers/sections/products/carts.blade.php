      <div class="cart clearfix animate-effect">
          <div class="action">
              <ul class="list-unstyled">
                  <li class="add-cart-button btn-group">

                      <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal"
                          data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i
                              class="fa fa-shopping-cart"></i> </button>
                  </li>
                   <button class="btn btn-primary icon" type="button" title="Add to wishlist"  id="{{ $product->id }}" onclick="addToWishList(this.id)">
                     <i class="icon fa fa-heart"></i> </button>
                  {{-- <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare">
                          <i class="fa fa-signal" aria-hidden="true"></i> </a> </li> --}}
              </ul>
          </div>
          <!-- /.action -->
      </div>
