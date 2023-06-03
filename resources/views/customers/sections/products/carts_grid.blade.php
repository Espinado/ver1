  <div class="cart clearfix animate-effect">
      <div class="action">
          <ul class="list-unstyled">
              <li class="add-cart-button btn-group">
                  {{-- <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                      <i class="fa fa-shopping-cart"></i>
                  </button> --}}
                  <button type="submit" onclick="productView(this.id)" class="btn btn-primary" data-toggle="modal"
                      data-target="#exampleModal" id="{{ $product->id }}">
                      <i class="fa fa-shopping-cart inner-right-vs"></i>{{ __('system.add_to_cart') }}</button>
              </li>
              {{-- <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i
                          class="icon fa fa-heart"></i> </a>
              </li> --}}
              {{-- <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i
                          class="fa fa-signal"></i> </a>
              </li> --}}
          </ul>
      </div>
      <!-- /.action -->
  </div>
