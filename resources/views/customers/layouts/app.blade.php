<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">


    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('customers/assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="cnt-home">

    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">
        @include('customers.sections.header')
    </header>

    <!-- ============================================== HEADER : END ============================================== -->
    @yield('content')
    <!-- ============================================================= FOOTER ============================================================= -->
    <footer id="footer" class="footer color-bg">
        @include('customers.sections.footer')
    </footer>

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('customers/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('customers/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('customers/assets/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
    <script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
// Start Product View with Modal
function productView(id){

    $.ajax({
        type: 'GET',
        url: '/product/view/modal/'+id,
        dataType:'json',
        success:function(data){
             $('#pname').text(data.product.product_name);
            $('#price').text(data.product.selling_price);
            $('#pcode').text(data.product.product_code);
            $('#pstock').text(data.product.product_qty);
            $('#pcategory').text(data.product.category.category_name);
            $('#pbrand').text(data.product.brand.brand_name);
           $('#pimage').attr('src','/'+data.product.product_thambnail);
        }
    })

}
</script>

    <!-- Add to Cart Product Modal -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img src=" " class="card-img-top" alt="..." style="height: 200px; width: 200px;" id="pimage">
                            </div>

                        </div>
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">Product price:&nbsp; <strong id="price"></strong></li>
                                <li class="list-group-item">Product code:&nbsp;  <strong id="pcode"></strong></li>
                                <li class="list-group-item">Category:&nbsp; <strong id="pcategory"></strong></li>
                                <li class="list-group-item">Brand:&nbsp; <strong id="pbrand"></strong></li>
                                <li class="list-group-item">Stock:&nbsp;<strong id="pstock"></strong></li></li>
                            </ul>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Choose color:</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                             <div class="form-group">
                                <label for="exampleFormControlSelect1">Choose size:</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Add to cart</button>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Add to Cart Product Modal -->

</body>

</html>
