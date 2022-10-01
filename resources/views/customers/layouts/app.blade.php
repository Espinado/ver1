<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Unitas">
    <meta name="keywords" content="Unitas, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('page_title')</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('customers/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('customers/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('customers/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('customers/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('customers/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('customers/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('customers/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('customers/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('customers/css/custom.css') }}" type="text/css">
</head>


<body>

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>


    <!-- Header Section Begin -->
    @include('customers.sections.header')
    <!-- Header Section End -->


    @yield('content')


    <!-- Footer Section Begin -->
    @include ('customers.sections.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->

    <script src="{{ asset('customers/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('customers/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('customers/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('customers/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('customers/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('customers/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('customers/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('customers/js/main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('customers/js/custom.js') }}"></script>
    <script>

    </script>

    <!-- Js Plugins -->

</body>


</html>
