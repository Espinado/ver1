@extends('customers.layouts.app')
@section('content')

@section('title')
    Bank {{ __('system.payment_process') }}
@endsection
@php
    use Firebase\JWT\JWT;
    use GuzzleHttp\Client;
    $payload = [
        'accessKey' => config('app.montonio.access'),
        'iat' => time(),
        'exp' => time() + 90 * 90,
    ];

    $auth_header = JWT::encode($payload, config('app.montonio.secret'), 'HS256');

    $client = new Client();
    $response = $client->request('GET', 'https://sandbox-stargate.montonio.com/api/stores/setup', [
        'headers' => [
            'Authorization' => 'Bearer ' . $auth_header,
        ],
    ]);

    $body = $response->getBody()->getContents();
    $tmp = json_decode($body, true)['paymentMethods']['paymentInitiation']['setup']['LV']['paymentMethods'];

@endphp
<
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
                                             @foreach ($tmp as $t)
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle"><b>{{ $t['name'] }}</b>
                                                </h4>


                                                        <img src="{{ $t['logoUrl'] }}" style="width: 150px; height:50px">
                                                   <input type="radio" name="bank">




                                            </div>
                                            @endforeach

                                            <!-- already-registered-login -->

                                            <!-- already-registered-login -->

                                    </div class="row">
                                    <hr>
                                    <!-- already-registered-login -->

                                </div>
                                <!-- panel-body  -->


                            </div><!-- row -->
                            <button type="submit"
                                class="btn-upper btn btn-primary checkout-page-button">{{ __('system.payment_step') }}</button>
                        </div>
                        <!-- checkout-step-01  -->

                    </div><!-- /.checkout-steps -->
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


{{-- <div class="container">
<div class="row">
 @foreach ($tmp as $t)
 {{-- <div class="card">

 </div> --}}
{{-- <div class="col-md-6 col-12">
    <div class="box">
        <div class="box-body">
   <img src="{{$t['logoUrl']}}">
        </div>
</div>
 </div>
       @endforeach
</div>
 </div> --}} --}}
@endsection
