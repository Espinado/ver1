@extends('customers.layouts.app')
@section('content')
@section('title')
    {{ __('system.cart_page') }}
@endsection
@php
$cart=Cart::content();
// dd($cart);
@endphp

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">{{ __('system.home') }}</a></li>
                <li class='active'>{{ __('system.cart') }}</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row ">
             @if(!$cart->isEmpty())
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">

                        <table class="table">
                            <thead>

                                <th class="cart-romove item">{{ __('system.image') }}</th>
                                <th class="cart-description item">{{ __('system.name') }}</th>
                                <th class="cart-product-name item">{{ __('system.color') }}</th>
                                <th class="cart-edit item">{{ __('system.size') }}</th>
                                <th class="cart-qty item">{{ __('system.quantity') }}</th>
                                <th class="cart-sub-total item">{{ __('system.subtotal') }}</th>
                                <th class="cart-total last-item">{{ __('system.remove') }}</th>
                            </thead>
                            <tbody id="cartPage">



                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    @if (Session::has('coupon'))

                    @else

                    @endif
                </div>

                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                     @if(!Session::has('coupon'))
                    <table class="table" id="couponField">
                        <thead>
                            <tr>
                                <th>
                                    <span class="estimate-title">{{ __('system.discount_code') }}</span>
                                    <p>{{ __('system.enter_coupon') }}</p>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control unicase-form-control text-input"
                                            placeholder="You Coupon.." id="coupon_name">
                                    </div>
                                    <div class="clearfix pull-right">
                                        <button type="submit" class="btn-upper btn btn-primary"
                                            onclick="applyCoupon()">{{ __('system.apply_coupon') }}</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->

                    </table><!-- /table -->
                    @endif
                </div><!-- /.estimate-ship-tax -->


                <div class="col-md-4 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead id="couponCalc">

                        </thead><!-- /thead -->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="cart-checkout-btn pull-right">
                                        <a href="{{route('product.checkout')}}" type="submit" class="btn btn-primary checkout-btn">{{ __('system.proceed_to_checkout') }}</a>

                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->
            </div><!-- /.row -->
            @else
            Empty cart
            @endif
        </div><!-- /.sigin-in-->




        <br>
        @include('customers.sections.brands')
    </div>
@endsection
