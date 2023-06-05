@extends('customers.layouts.app')
@section('content')

@section('title')
    Stripe {{ __('system.payment_process') }}
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">{{ __('system.home') }}</a></li>
                <li class='active'>Stripe</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

{{-- @dd($data) --}}
<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">

                <div class="col-md-6">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">{{ __('system.total') }} </h4>
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
                                                    <strong>Tax {{$data['tax_rate']}}%: </strong>  &nbspEUR &nbsp{{ $data['tax_sum'] }}
                                                    <hr>
                                                     <strong>Delivery cost: </strong> EUR {{ $data['delivery_cost'] }}
                                                     <hr>



                                                    <strong>Grand Total : </strong> EUR
                                                    {{ session()->get('coupon')['total_amount']+ $data['delivery_cost']  }}
                                                    <hr>
                                                @else
                                                    <strong>SubTotal: </strong> EUR {{ $data['SubTotal_without_discount'] }}
                                                    <hr>
                                                    <strong>Tax: </strong> EUR {{ $data['tax_sum'] }}
                                                    <hr>

                                                     <strong>Delivery cost: </strong> EUR {{ $data['delivery_cost'] }}
                                                     <hr>

                                                    <strong>Grand Total : </strong> EUR {{ $data['GrandTotal']  }}
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
                                    <h4 class="unicase-checkout-title"> {{ __('system.payment_method') }}</h4>
                                </div>


                                <form action="{{ route('stripe.order') }} " method="post" id="payment-form">
                                    @csrf
                                    <div class="form-row">
                                        <label for="card-element">
                                             <input type="hidden" name="data" value="{{ json_encode($data) }}">

                                            {{ __('system.credit_or_debit_card') }}
                                        </label>

                                        <div id="card-element">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>
                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary">{{ __('system.submit_payment') }}</button>&nbsp;&nbsp;&nbsp;
                                     <a href="{{ URL::previous() }}" class="btn btn-danger">Back to checkout</a> <!-- New button added -->
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div><!--  // end col md 6 -->



                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- === ===== BRANDS CAROUSEL ==== ======== -->








        <!-- ===== == BRANDS CAROUSEL : END === === -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

<script type="text/javascript">
    // Create a Stripe client.
    var stripe = Stripe(
        'pk_test_51MdxE0LYuNRuHnSIJ9qzt6TM4Xngs9oADGUmIbqU3BDBJea0XBrp3TTG0dHfIXMPfrRiludv7AIfuTjK4LJGHSas00Rrda38km'
    );
    // Create an instance of Elements.
    var elements = stripe.elements();
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style
    });
    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');
    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });
    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // Submit the form
        form.submit();
    }
</script>



@endsection
