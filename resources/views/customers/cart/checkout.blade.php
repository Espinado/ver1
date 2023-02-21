@extends('customers.layouts.app')
@section('content')
@section('title')
    Checkout
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">



                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- already-registered-login -->
                                     <form class="register-form" action="{{ route('checkout.store') }}" method="POST">
                                        @csrf
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle"><b>Shipping address</b></h4>


                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Shipping
                                                            name</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" name="shipping_name"
                                                        placeholder="Full name" required=""
                                                        @auth value="{{ Auth::user()->name }}" @endauth>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Shipping
                                                            email</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" name="shipping_email"
                                                        placeholder="Full email" required=""
                                                        @auth value="{{ Auth::user()->email }}" @endauth>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Shipping
                                                           phone</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" name="shipping_phone"
                                                        placeholder="Phone" required=""
                                                        @auth value="{{ Auth::user()->phone }}" @endauth>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Shipping
                                                            postcode</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" name="shipping_postcode" required=""
                                                        placeholder="Postcode"
                                                        @auth value="{{ Auth::user()->postcode }}" @endauth>
                                                </div>


                                        </div>

                                        <!-- already-registered-login -->

                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">

                                            <div class="form-group">
                                                <h5><b>Division Select </b><span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="division_id" class="form-control">
                                                        <option value="" selected="" disabled=""><b>Select
                                                                Division</b></option>
                                                        @foreach ($divisions as $div)
                                                            <option value="{{ $div->id }}">
                                                                {{ $div->division_name }}</option>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('division_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5><b>District Select</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="district_id" class="form-control">
                                                        <option value="" selected="" disabled=""><b>Select
                                                                district</b></option>

                                                    </select>
                                                    @error('district_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>State Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="state_id" class="form-control">
                                                        <option value="" selected="" disabled=""><b>Select
                                                                state</b></option>

                                                    </select>
                                                    @error('state_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1"><b>Notes</b>
                                                    <span>*</span></label>
                                                <textarea class="form-control" cols="30" rows="5" placeholder="Notes" name="notes"></textarea>
                                            </div>

                                        </div>
                                    </div class="row">
                                    <hr>
                                    <!-- already-registered-login -->
                                    <div class="row">
                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle"><b>Select payment method</b></h4>
                                            <div class="form-group">
                                                <label class="info-title" for="payment"><b>Stripe</b>&nbsp;&nbsp; </label>
                                                <input type="radio" name="payment_method" value="stripe">
                                                <img src="{{asset('customers/assets/images/payments/4.png')}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="payment"><b>Card</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                                                <input type="radio" name="payment_method" value="card" disabled>
                                                 <img src="{{asset('customers/assets/images/payments/3.png')}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="payment"><b>Cash</b>&nbsp;&nbsp;&nbsp;&nbsp; </label>
                                                <input type="radio" name="payment_method" value="cash">
                                                 <img src="{{asset('customers/assets/images/payments/2.png')}}">
                                            </div>
                                        </div> <!
                                        <hr>





                                        <!-- already-registered-login -->

                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle"><b>Select shipping method</b></h4>

                                            <div class="form-group">
                                                <label class="info-title" for="shipping_method"><b>Receive in store</b> </label>
                                                <input type="radio" name="shipping_method" value="self" selected>
                                            </div>


                                        </div>
                                        <!-- already-registered-login -->
                                     </div>
                                                           </div>
                                <!-- panel-body  -->


                            </div><!-- row -->
                             <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>
                        </div>
                        <!-- checkout-step-01  -->

                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach ($carts as $item)
                                            <li><img src="{{ asset($item->options->image) }}"
                                                    style="height:50px; width:50px;"> </li>
                                            <li><strong>Product:</strong>&nbsp;{{ $item->name }}</li>
                                            <li>
                                                <strong>Qty:</strong>&nbsp;({{ $item->qty }})&nbsp;
                                                <strong>Color: &nbsp</strong>({{ $item->options->color }})&nbsp;
                                                <strong>Size: &nbsp</strong>({{ $item->options->size }})
                                            </li>
                                            <br>
                                        @endforeach
                                        <li>
                                            @if (Session::has('coupon'))
                                                <strong>Subtotal:</strong> &nbsp;{{ $cartTotal }}
                                                <hr>
                                                <strong>Coupon:</strong>
                                                &nbsp;{{ session()->get('coupon')['coupon_name'] }}&nbsp;
                                                {{ session()->get('coupon')['coupon_discount'] }}%<br>
                                                <strong>Discount:</strong>&nbsp;{{ session()->get('coupon')['discount_amount'] }}&nbsp;EUR
                                                <hr>
                                                <strong>Total:</strong>&nbsp;{{ session()->get('coupon')['total_amount'] }}&nbsp;EUR
                                            @else
                                                <strong>Subtotal:</strong> &nbsp;{{ $cartTotal }}
                                                <hr>
                                                <strong>Grandtotal:</strong> &nbsp;{{ $cartTotal }}
                                                <hr>
                                            @endif

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>

            </div><!-- /.row -->
        </form>

        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('customers.sections.brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div>
<!-- /.body-content -->

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function() {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{ url('/division/district/ajax') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="district_id"]').html('');
                        $('select[name="state_id"]').html('');
                        $('select[name="district_id"]').append(
                            '<option value="" disabled="" selected="">Select it</option>'
                        );
                        $('select[name="state_id"]').append(
                            '<option value="" disabled="" selected="">Select it</option>'
                        );
                        $.each(data, function(key, value) {
                            $('select[name="district_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
        $('select[name="district_id"]').on('change', function() {
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: "{{ url('/get/states/ajax') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $.each(data, function(key, value) {
                            $('select[name="state_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .state_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>
@endsection
