<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('customers/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('customers/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('customers/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('customers/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('customers/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('customers/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customers/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('customers/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customers/assets/css/lightbox.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
     <link rel="stylesheet" href="{{ asset('customers/assets/css/stripe.css') }}">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('customers/assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


</head>

<body class="cnt-home" id="body">
    {!! EuCookieConsent::getPopup() !!}

    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">
        @include('customers.sections.header')
    </header>
    <div id="loading">
        <img src="{{ asset('loader.gif') }}" alt="Loading...">
    </div>
    </div>

    <!-- ============================================== HEADER : END ============================================== -->
    @yield('content')
    <!-- ============================================================= FOOTER ============================================================= -->
    <footer id="footer" class="footer color-bg">
        @include('customers.sections.footer')
    </footer>

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('customers/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/bootstrap.min.js') }}"></script>


    <script src="{{ asset('customers/assets/js/bootstrap-select.min.js') }}"></script>

    <script src="{{ asset('customers/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/loader.js') }}"></script>
    <script src="{{ asset('customers/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/jquery.rateit.min.js') }}"></script>

    <script src="{{ asset('customers/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('customers/assets/js/product_view.js') }}"></script>
     <script src="{{ asset('customers/assets/js/shopping_cart.js') }}"></script>
      <script src="{{ asset('customers/assets/js/wishlist.js') }}"></script>
       <script src="{{ asset('customers/assets/js/coupon.js') }}" defer></script>
       <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
       <script>
  function preventScrollToTop() {
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  }
</script>

         <script>
        window.baseURL = "{{ url('/') }}";
    var checkoutRouteURL = "{{ route('product.checkout') }}";
</script>
</script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
 <script>
        // Expose translations to JavaScript using data attributes
        var translations = {
            subtotal: "{{ __('system.subtotal') }}",
            checkout: "{{ __('system.checkout') }}"
        };
    </script>


    <!-- Modal -->
    <div class="modal" tabindex="-1" id="exampleModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel"><strong><span id="pname"></span></strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="card" style="width: 100%;">
                                <img src=" " class="card-img-top" alt="..."
                                    style="height: 200px; width: 100%;" id="pimage">
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <ul class="list-group">
                                <li class="list-group-item">{{ __('system.product_price') }}: <strong
                                        class="text-danger"><span id="pprice"></span></strong>&nbsp;<del
                                        id="oldprice"></del></li>
                                <li class="list-group-item">{{ __('system.product_code') }}: <strong
                                        id="pcode"></strong></li>
                                <li class="list-group-item">{{ __('system.category') }}: <strong
                                        id="pcategory"></strong></li>
                                <li class="list-group-item">{{ __('system.brand') }}: <strong id="pbrand"></strong>
                                </li>
                                <li class="list-group-item">{{ __('system.stock') }}:<span
                                        class="badge badge-pill badge-success" id="available"
                                        style="background: green; color:white"></span><span
                                        class="badge badge-pill badge-danger" id="notavailable"
                                        style="background: red; color:white"></span><strong id="pstock"></strong>
                                </li>
                            </ul>
                            <div class="form-group">
                                <label for="color">{{ __('system.choose_color') }}:</label>
                                <select class="form-control" id="color" name="color"></select>
                            </div>
                            <div class="form-group" id="sizeArea">
                                <label for="size">{{ __('system.choose_size') }}:</label>
                                <select class="form-control" id="size" name="size"></select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">{{ __('system.quantity') }}</label>
                                <input type="number" id="quantity" name="quantity" class="form-control"
                                    value="1" min="1">
                            </div>
                            <input type="hidden" name="product_id" id="product_id">
                            <button type="submit" class="btn btn-primary mb-2"
                                onclick="addToCart()">{{ __('system.add_to_cart') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Add to Cart Product Modal -->

</body>

</html>
