@extends('customers.layouts.app')
@section('content')
@section('title')
    {{ __('system.checkout') }}
@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

@php
    $user = Auth::user();
@endphp

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
                                                        value="{{ $user['user_profile']['name'] . ' ' . $user['user_profile']['surname'] }}">
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
                                                        value="{{ $user['user_profile']['email'] }}">
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
                                                        value="{{ $user['user_profile']['phone'] }}">
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
                                                        @auth value="{{ $user['user_profile']['postcode'] }}" @endauth>
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
                                                        <select name="division_id" class="form-control" id="division">
                                                            <option
                                                                value="{{ $user->user_profile->division ? $user->user_profile->division->id : '' }}">
                                                                <b>{{ $user->user_profile->division ? $user->user_profile->division->division_name : '' }}</b>
                                                            </option>
                                                            @foreach ($divisions as $div)
                                                                <option value="{{ $div->id }}">
                                                                    {{ $div->division_name }}
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
                                                        <select id="district" name="district_id" class="form-control">
                                                          <option
                                                                value="{{ $user->user_profile->district ? $user->user_profile->district->id : '' }}">
                                                                <b>{{ $user->user_profile->district ? $user->user_profile->district->district_name : '' }}</b>
                                                            </option>
                                                            @foreach ($districts as $dis)
                                                                <option value="{{ $dis->id }}">
                                                                    {{ $dis->district_name }}
                                                                </option>
                                                            @endforeach


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
                                                        <select name="state_id" class="form-control" id="state">
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
                                                        data-cost="0,00">
                                                    <input type="text" name="shipping_cost" value="0.00"
                                                        disabled style="width:50px;">EUR
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="shipping_method"><b>{{ __('system.delivery') }}</b>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </label>
                                                    <input type="radio" name="shipping_method" value="delivery"
                                                        data-cost="{{$user['user_profile']['district']['delivery_cost']}}">
                                                    <input type="text" name="shipping_cost" id="shipping_cost"
                                                        value="{{ $user['user_profile']['district']? $user['user_profile']['district']['delivery_cost'] : 'N/A' }}"
                                                        disabled style="width:50px;">EUR
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

                                        </li><strong>{{ __('system.delivery_cost') }}:</strong>&nbsp;<span
                                            id="cost">{{$user['user_profile']['district']? $user['user_profile']['district']['delivery_cost']: ''}}</span> EUR<li>
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
        $('#district').select2({
            placeholder: 'Select district',
            language: "fr",
            theme: "classic"
        });
        $('#division').select2({
            placeholder: 'Select division',
            language: "fr",
            theme: "classic"
        });
        $('#state').select2({
            placeholder: 'Select division',
            theme: "classic",
            language: "fr"
        });


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
                 $.ajax({
                    url: "{{ url('/get/district/delivery/rates') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(rate) {
                        console.log(rate.rate.delivery_cost)
                        $('#cost').html(rate.rate.delivery_cost);
                        $('#shipping_cost').val('');
                         $('#shipping_cost').val(rate.rate.delivery_cost);


                    },
                });
            } else {
                alert('danger');
            }
        });
        $('input[name="shipping_method"]').on('change', function() {
            // Get the value of the selected radio button's data-cost attribute
            var shippingCost = $('input[name="shipping_method"]:checked').data('cost');

            // Update the #cost element with the shippingCost value
            $('#cost').html(shippingCost);

            // Log the value to the console for debugging
            console.log(shippingCost);
            $('#cost').html(shippingCost)
        });
        var district_delivery_cost = $('#district').val();
        console.log(district_delivery_cost)
        //  $.ajax({
        //                     url: "{{ url('/get/rates/ajax') }}/" + district_id,
        //                     type: "GET",
        //                     dataType: "json",
        //                     success: function(data) {
        //                     }
        // $('#cost').html(district_delivery_cost);

    });
</script>
@endsection
