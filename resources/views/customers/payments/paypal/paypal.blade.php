@extends('customers.layouts.app')
@section('content')
@section('title')
    Paypal
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li class='active'>Paypal</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->




    <div class="body-content">
        <div class="container">
            <div class="checkout-box ">
                <div class="row">



                    {{-- @dd($data); --}}

                    <div class="col-md-6">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Your Shopping Amount </h4>
                                    </div>
                                    <div class="">
                                        <ul class="nav nav-checkout-progress list-unstyled">


                                            <hr>
                                            <li>
                                                @if (Session::has('coupon'))
                                                    <strong>Amount: </strong> EUR {{ $data['SubTotal_without_discount'] }}
                                                    <hr>

                                                    <strong>Coupon Name : </strong>
                                                    {{ session()->get('coupon')['coupon_name'] }}
                                                    ( {{ session()->get('coupon')['coupon_discount'] }} % )
                                                    <hr>
                                                    <strong>Coupon Discount : </strong> EUR
                                                    {{ session()->get('coupon')['discount_amount'] }}
                                                    <hr>
                                                    <strong>SubTotal: </strong> EUR {{ $data['SubTotal_with_discount'] }}
                                                    <hr>

                                                    <strong>Delivery cost: </strong> EUR {{ $data['delivery_cost'] }}
                                                    <hr>
                                                    <strong>Tax {{ $data['tax_rate'] }}%: </strong> &nbspEUR
                                                    &nbsp{{ $data['tax_sum'] }}
                                                    <hr>



                                                    <strong>Grand Total : </strong> EUR
                                                    {{ session()->get('coupon')['total_amount'] + $data['delivery_cost'] }}
                                                    <hr>
                                                @else
                                                    <strong>SubTotal: </strong> EUR
                                                    {{ $data['SubTotal_without_discount'] }}
                                                    <hr>


                                                    <strong>Delivery cost: </strong> EUR {{ $data['delivery_cost'] }}
                                                    <hr>
                                                     <strong>Tax: </strong> EUR {{ $data['tax_sum'] }}
                                                    <hr>

                                                    <strong>Grand Total : </strong> EUR {{ $data['GrandTotal'] }}
                                                    <hr>
                                                @endif

                                            </li>



                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                    </div> <!--  // end col md 6 -->



                   <div class="col-md-6">
    <!-- checkout-progress-sidebar -->
    <div class="checkout-progress-sidebar ">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="unicase-checkout-title">Payment Method</h4>
                </div>
                <img src="{{ asset('customers/assets/images/payments/1.png') }}">

                <form action="{{ route('paypal.payment') }}" method="post" id="payment-form">
                    @csrf
                    <div class="form-row">
                        <label for="card-element">
                            <input type="hidden" name="data" value="{{ json_encode($data) }}">
                        </label>
                    </div>
                    <br>
                    <button class="btn btn-primary">Submit Payment</button>&nbsp;&nbsp;&nbsp;
                    <a href="{{ URL::previous() }}" class="btn btn-danger">Back to checkout</a> <!-- New button added -->
                    <br>
                </form>
            </div>
        </div>
    </div>
    <!-- checkout-progress-sidebar -->
</div><!--  // end col md 6 -->
<script>
    function goBack() {
        window.history.back(); // Go back to the previous URL
    }
</script>
                    </form>
                </div><!-- /.row -->
            </div><!-- /.checkout-box -->
            <!-- === ===== BRANDS CAROUSEL ==== ======== -->

            <!-- ===== == BRANDS CAROUSEL : END === === -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->



@endsection
