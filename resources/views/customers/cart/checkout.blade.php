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
                                                    <label class="info-title"><b>{{ __('system.shipping_name') }}</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        name="shipping_name" placeholder="Name"
                                                        value="{{ $user['user_profile']['name'] }}">
                                                    @error('shipping_name')
                                                        <div class="alert alert-danger"><b>{{ $message }}</b></div>
                                                    @enderror

                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"><b>{{ __('system.shipping_surname') }}</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        name="shipping_surname" placeholder="Surname"
                                                        value="{{ $user['user_profile']['surname'] }}">
                                                    @error('shipping_surname')
                                                        <div class="alert alert-danger"><b>{{ $message }}</b></div>
                                                    @enderror

                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1"><b>{{ __('system.shipping_email') }}</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        name="shipping_email" placeholder="Full email"
                                                        value="{{ $user['user_profile']['email'] }}">
                                                    @error('shipping_email')
                                                        <div class="alert alert-danger"><b>{{ $message }}</b></div>
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
                                                        <div class="alert alert-danger"><b>{{ $message }}</b></div>
                                                    @enderror
                                                </div>



                                            </div>

                                            <!-- already-registered-login -->

                                            <!-- already-registered-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">

                                                <div class="form-group">
                                                    <h5><b>{{ __('system.country') }}</b><span
                                                            class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="division_id" class="form-control" id="division">
                                                            <option
                                                                value="{{ $user->user_profile->division ? $user->user_profile->division->id : '' }}">
                                                                <b>{{ $user->user_profile->division ? $user->user_profile->division->division_name : '' }}</b>
                                                            </option>
                                                            @foreach ($divisions as $div)
                                                                @if ($user->user_profile->division && $user->user_profile->division->id != $div->id)
                                                                    <option value="{{ $div->id }}">
                                                                        {{ $div->division_name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('division_id')
                                                            <div class="alert alert-danger"><b>{{ $message }}</b>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5><b>{{ __('system.city') }}</b> <span
                                                            class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select id="district" name="district_id" class="form-control">
                                                            @foreach ($districts as $dis)
                                                                @if ($user->user_profile->district && $user->user_profile->district->id == $dis->id)
                                                                    <option value="{{ $dis->id }}"
                                                                        data-delivery-cost="{{ $dis->delivery_cost }}"
                                                                        selected>
                                                                        {{ $dis->district_name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $dis->id }}"
                                                                        data-delivery-cost="{{ $dis->delivery_cost }}">
                                                                        {{ $dis->district_name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('district_id')
                                                            <div class="alert alert-danger"><b>{{ $message }}</b>
                                                            </div>
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
                                                            <div class="alert alert-danger"><b>{{ $message }}</b>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1"><b>{{ __('system.notes') }}</b>
                                                        <span>*</span></label>
                                                    <textarea class="form-control" cols="20" rows="2" placeholder="{{ __('system.notes') }}" name="notes"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1"><b>{{ __('system.shipping_postcode') }}</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" name="shipping_postcode"
                                                        placeholder="Postcode"
                                                        value="{{ $user['user_profile']['postcode'] }}">
                                                    @error('shipping_postcode')
                                                        <div class="alert alert-danger"><b>{{ $message }}</b></div>
                                                    @enderror
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
                                                <input type="radio" name="payment_method" value="stripe"
                                                    title="card">
                                                <label class="info-title" for="payment"><b>
                                                        <img
                                                            src="{{ asset('customers/assets/images/payments/3.png') }}"></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>


                                            </div>
                                            <div class="form-group" title="cash">
                                                <input type="radio" name="payment_method" value="cash"
                                                    title="cash">
                                                <label class="info-title" for="payment"><b>
                                                        <img src="{{ asset('customers/assets/images/payments/cash.png') }}"
                                                            height="34px" title="cash"></b>

                                                </label>

                                            </div>
                                            <div class="form-group" title="bank">
                                                <input type="radio" name="payment_method" value="bank"
                                                    title="bank">
                                                <label class="info-title" for="payment"><b>
                                                        <img src="{{ asset('customers/assets/images/payments/bank.jpg') }}"
                                                            height="34px" title="bank"></b>

                                                </label>

                                            </div>
                                            <div class="form-group" title="bank">
                                                <input type="radio" name="payment_method" value="paypal"
                                                    title="Paypal">
                                                <label class="info-title" for="payment"><b>
                                                        <img src="{{ asset('customers/assets/images/payments/1.png') }}"
                                                            height="34px" title="Paypal"></b>

                                                </label>

                                            </div>

                                            @error('payment_method')
                                                <div class="alert alert-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>
                                        <! <hr>





                                            <!-- already-registered-login -->

                                            <!-- already-registered-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle">
                                                    <b>{{ __('system.shipping_method') }}</b>
                                                </h4>

                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="shipping_method"><b>{{ __('system.collect_in_store') }}</b>&nbsp;</label>
                                                    <input type="radio" name="shipping_method" value="self"
                                                        data-cost="0.00" checked>
                                                    <input type="text" name="shipping_cost" value="0.00"
                                                        disabled style="width:50px;">EUR
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="shipping_method"><b>{{ __('system.delivery') }}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                    <input type="radio" name="shipping_method" value="delivery"
                                                        data-cost="{{ $user['user_profile']['district']['delivery_cost'] }}">
                                                    <input type="text" name="shipping_cost" id="shipping_cost"
                                                        value="{{ $user['user_profile']['district'] ? $user['user_profile']['district']['delivery_cost'] : 'N/A' }}"
                                                        disabled style="width:50px;">EUR
                                                </div>

                                                @error('shipping_method')
                                                    <div class="alert alert-danger"><b>{{ $message }}</b></div>
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
                                                <strong>{{ __('system.total') }}:</strong>&nbsp;<span id="sum"
                                                    name="sum"
                                                    class="text-danger">{{ session()->get('coupon')['total_amount'] }}</span>
                                            @else
                                                <strong>{{ __('system.subtotal') }}:</strong>
                                                &nbsp; <span id="sum"
                                                    name="sum">{{ $cartTotal }}</span>&nbsp;EUR
                                                <hr>
                                            @endif

                                            <strong>{{ __('system.delivery_cost') }}:</strong>&nbsp;<span
                                                class="text-danger" id="delivery_cost"
                                                name="delivery_cost">{{ $user['user_profile']['district'] ? $user['user_profile']['district']['delivery_cost'] : '0.00' }}</span>
                                            EUR
                                            <hr>
                                            <strong>{{ __('system.grand_total') }}:</strong>
                                            &nbsp;<span id="full_total"
                                                class="text-danger">{{ $cartTotal }}</span>&nbsp;EUR
                                            <hr>

                                        </li>
                                        <li>
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

<script src="{{ asset('customers/assets/js/checkout.js') }}" defer></script>
@endsection
