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
    <style>
        .modal-content {
            width: 800px;
            right: 100px;
        }
    </style>
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
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        // Start Product View with Modal
        function productView(id) {

            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    $('#oldprice').empty();
                    $('#pname').text(data.product.product_name);
                    $('#product_id').val(data.product.id);
                    $('#price').text(data.product.selling_price);
                    $('#pcode').text(data.product.product_code);
                    if (data.product.product_qty > 0) {
                        $('#available').text(data.product.product_qty);
                        $('#notavailable').text('');
                    } else {
                        $('#available').text('');
                        $('#notavailable').text('Not in stock');
                    }
                    $('#pcategory').text(data.product.category.category_name);
                    $('#pbrand').text(data.product.brand.brand_name);
                    $('#pimage').attr('src', '/' + data.product.product_thambnail);
                    if (data.product.discount_price == null) {
                        $('#pprice').text(data.product.selling_price);
                        $('#oldprice').text('');
                    } else {
                        $('#pprice').text(data.product.discount_price);
                        $('#oldprice').text(data.product.selling_price);
                    }
                    $('select[name="color"]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="color"]').append('<option value="' + value + '">' + value +
                            '</option>');
                    })
                    $('select[name="size"]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="size"]').append('<option value="' + value + '">' + value +
                            '</option>');
                        if (data.size == "") {
                            $('#sizeArea').hide();
                        } else {
                            $('#sizeArea').show();
                        }
                    })
                }
            })
        }

        //Add to cart
        function addToCart() {
            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            var color = $('#color option:selected').text();
            var size = $('#size option:selected').text();
            var quantity = $('#quantity').val();

            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    product_name: product_name,
                    id: id,
                    color: color,
                    size: size,
                    quantity: quantity,
                },
                url: "/cart/data/store/" + id,
                success: function(data) {
                     miniCart()
                    $('#closeModal').click();
                    const toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 3500
                    })
                    if ($.isEmptyObject(data.error)) {
                        toast.fire({
                            type: 'success',
                            'title': data.success
                        })
                    } else {
                        toast.fire({
                            type: 'error',
                            'title': data.error
                        })
                    }
                },
            })
        }
    </script>
    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type: "GET",
                url: "/cart/data/read",
                dataType: 'json',
                success: function(response) {
                      $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);
                    var miniCart = ""
                    $.each(response.carts, function(key, value) {
                        miniCart += `<div class="cart-item product-summary">
                 <div class="row">
            <div class="col-xs-4">
              <div class="image"> <a href="detail.html"><img src="/${value.options.image}" alt=""></a> </div>
            </div>
            <div class="col-xs-7">
              <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
              <div class="price"> ${value.price} * ${value.qty} </div>
            </div>
            <div class="col-xs-1 action"> <a href="#"><i class="fa fa-trash"></i></a> </div>
          </div>
        </div>
        <!-- /.cart-item -->
        <div class="clearfix"></div>
        <hr>`
                    });

                    $('#miniCart').html(miniCart);
                },
                error: function(error) {

                }

            });

        }
    </script>

    <!-- Add to Cart Product Modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span></strong> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img src=" " class="card-img-top" alt="..."
                                    style="height: 200px; width: 200px;" id="pimage">
                            </div>

                        </div>
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">Product price: <strong class="text-danger"><span
                                            id="pprice"></span></strong>&nbsp;<del id="oldprice"></del></li>

                                <li class="list-group-item">Product code: <strong id="pcode"></strong></li>
                                <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                                <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                                <li class="list-group-item">Stock:<span class="badge badge-pill badge-success"
                                        id="available" style="background: green; color:white"></span>
                                    <span class="badge badge-pill badge-danger" id="notavailable"
                                        style="background: red; color:white"></span>
                                    <strong id="pstock"></strong>
                                </li>
                                </li>
                            </ul>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="color">Choose color:</label>
                                <select class="form-control" id="color" name="color">

                                </select>
                            </div>
                            <div class="form-group" id="sizeArea">
                                <label for="size">Choose size:</label>
                                <select class="form-control" id="size" name="size">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" name="quantity" class="form-control"
                                    value="1" min="1">
                            </div>
                            <input type="hidden" name="product_id" id="product_id">
                            <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to
                                cart</button>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Add to Cart Product Modal -->

</body>

</html>
