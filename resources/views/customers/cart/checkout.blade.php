@extends('customers.layouts.app')
@section('content')
@section('title')
    {{ __('system.checkout') }}
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('index') }}">{{ __('system.home') }}</a></li>
                <li class='active'>{{ __('system.checkout') }}</li>
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
                                        <form class="register-form" action="{{ route('checkout.store') }}"
                                            method="POST">
                                            @csrf
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle"><b>{{ __('system.shipping_address') }}</b>
                                                </h4>


                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1"><b>{{ __('system.shipping_name') }}</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" name="shipping_name"
                                                        placeholder="Full name"
                                                        @auth value="{{ Auth::user()->name }}" @endauth>
                                                    @error('shipping_name')
                                                        <span class="text-danger"><b>{{ $message }}</b></span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1"><b>{{ __('system.shipping_email') }}</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" name="shipping_email"
                                                        placeholder="Full email"
                                                        @auth value="{{ Auth::user()->email }}" @endauth>
                                                    @error('shipping_email')
                                                        <span class="text-danger"><b>{{ $message }}</b></span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1"><b>{{ __('system.shipping_phone') }}</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" name="shipping_phone"
                                                        placeholder="Phone"
                                                        @auth value="{{ Auth::user()->phone }}" @endauth>
                                                         @error('shipping_phone')
                                                        <span class="text-danger"><b>{{ $message }}</b></span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1"><b>{{ __('system.shipping_postcode') }}</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" name="shipping_postcode"
                                                        placeholder="Postcode"
                                                        @auth value="{{ Auth::user()->postcode }}" @endauth>
                                                    @error('shipping_postcode')
                                                        <span class="text-danger"><b>{{ $message }}</b></span>
                                                    @enderror
                                                </div>


                                            </div>

                                            <!-- already-registered-login -->

                                            <!-- already-registered-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">

                                                <div class="form-group">
                                                    <h5><b>{{ __('system.division') }}</b><span
                                                            class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="division_id" class="form-control">
                                                            <option value="" selected="" disabled="">
                                                                <b>{{ __('system.select_division') }}</b>
                                                            </option>
                                                            @foreach ($divisions as $div)
                                                                <option value="{{ $div->id }}">
                                                                    {{ $div->division_name }}</option>
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('division_id')
                                                            <span class="text-danger"><b>{{ $message }}</b></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5><b>{{ __('system.district') }}</b> <span
                                                            class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="district_id" class="form-control">
                                                            <option value="" selected="" disabled="">
                                                                <b>{{ __('system.select_district') }}</b>
                                                            </option>

                                                        </select>
                                                        @error('district_id')
                                                            <span class="text-danger"><b>{{ $message }}</b></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>{{ __('system.state') }} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <select name="state_id" class="form-control">
                                                            <option value="" selected="" disabled="">
                                                                <b>{{ __('system.select_state') }}</b>
                                                            </option>

                                                        </select>
                                                        @error('state_id')
                                                            <span class="text-danger"><b>{{ $message }}</b></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1"><b>{{ __('system.notes') }}</b>
                                                        <span>*</span></label>
                                                    <textarea class="form-control" cols="30" rows="5" placeholder="{{ __('system.notes') }}" name="notes"></textarea>
                                                </div>

                                            </div>
                                    </div class="row">
                                    <hr>
                                    <!-- already-registered-login -->
                                    <div class="row">
                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle">
                                                <b>{{ __('system.select_payment_method') }}</b>
                                            </h4>

                                            <div class="form-group">
                                                <label class="info-title" for="payment"><b><img
                                                            src="{{ asset('customers/assets/images/payments/3.png') }}"></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                                <input type="radio" name="payment_method" value="stripe"
                                                    title="card">

                                            </div>
                                            <div class="form-group" title="cash">
                                                <label class="info-title" for="payment"><b> <img
                                                            src="{{ asset('customers/assets/images/payments/cash.png') }}"
                                                            height="34px" title="cash"></b>

                                                </label>
                                                <input type="radio" name="payment_method" value="cash"
                                                    title="cash">
                                            </div>
                                             <div class="form-group" title="bank">
                                                <label class="info-title" for="payment"><b> <img
                                                            src="{{ asset('customers/assets/images/payments/bank.jpg') }}"
                                                            height="34px" title="bank"></b>

                                                </label>
                                                <input type="radio" name="payment_method" value="bank"
                                                    title="bank">
                                            </div>

                                            @error('payment_method')
                                                <span class="text-danger"><b>{{ $message }}</b></span>
                                            @enderror
                                        </div>
                                        <! <hr>





                                            <!-- already-registered-login -->

                                            <!-- already-registered-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle">
                                                    <b>{{ __('system.shipment_method') }}</b>
                                                </h4>

                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="shipping_method"><b>{{ __('system.select_in_store') }}</b>
                                                        &nbsp;</label>
                                                    <input type="radio" name="shipping_method" value="self"
                                                        selected>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="shipping_method"><b>{{ __('system.delivery') }}</b>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </label>
                                                    <input type="radio" name="shipping_method" value="delivery"
                                                        selected>
                                                </div>
                                                @error('shipping_method')
                                                    <span class="text-danger"><b>{{ $message }}</b></span>
                                                @enderror


                                            </div>
                                            <!-- already-registered-login -->
                                    </div>
                                </div>
                                <!-- panel-body  -->


                            </div><!-- row -->
                            <button type="submit"
                                class="btn-upper btn btn-primary checkout-page-button">{{ __('system.payment_step') }}</button>
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
                                    <h4 class="unicase-checkout-title">{{ __('system.checkout_progress') }}</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach ($carts as $item)
                                            <li><img src="{{ asset($item->options->image) }}"
                                                    style="height:50px; width:50px;"> </li>
                                            <li><strong>{{ __('system.product') }}:</strong>&nbsp;{{ $item->name }}
                                            </li>
                                            <li>
                                                <strong>{{ __('system.qty') }}:</strong>&nbsp;({{ $item->qty }})&nbsp;
                                                <strong>{{ __('system.color') }}:
                                                    &nbsp</strong>({{ $item->options->color }})&nbsp;
                                                <strong>{{ __('system.size') }}:
                                                    &nbsp</strong>({{ $item->options->size }})
                                            </li>
                                            <br>
                                        @endforeach
                                        <li>
                                            @if (Session::has('coupon'))
                                                <strong>{{ __('system.subtotal') }}:</strong>
                                                &nbsp;{{ $cartTotal }}
                                                <hr>
                                                <strong>{{ __('system.coupon') }}:</strong>
                                                &nbsp;{{ session()->get('coupon')['coupon_name'] }}&nbsp;
                                                {{ session()->get('coupon')['coupon_discount'] }}%<br>
                                                <strong>{{ __('system.discount') }}:</strong>&nbsp;{{ session()->get('coupon')['discount_amount'] }}
                                                <hr>
                                                <strong>{{ __('system.total') }}:</strong>&nbsp;{{ session()->get('coupon')['total_amount'] }}
                                            @else
                                                <strong>{{ __('system.subtotal') }}:</strong>
                                                &nbsp;{{ $cartTotal }}&nbsp;EUR
                                                <hr>
                                                <strong>{{ __('system.grand_total') }}:</strong>
                                                &nbsp;{{ $cartTotal }}&nbsp;EUR
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
