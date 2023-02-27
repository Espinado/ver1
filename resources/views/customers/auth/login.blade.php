@extends('customers.layouts.app')
@section('content')
@section('page_title')
   {{ __('system.login') }}
@endsection
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">{{ __('system.home') }}</a></li>
                    <li class='active'>{{ __('system.login') }}</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">{{ __('system.signin') }}</h4>
                        <p class="">{{ __('system.welcome_to_account') }}</p>
                        {{-- <div class="social-sign-in outer-top-xs">
                            <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with
                                Facebook</a>
                            <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                        </div> --}}
                        <form class="register-form outer-top-xs" role="form" method="POST"
                            action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">{{ __('system.email_address') }} <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input"
                                    id="exampleInputEmail1" name="email" value="{{ old('email') }}">
                                     @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">{{ __('system.password') }} <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="exampleInputPassword1" name="password">
                            </div>
                            <div class="radio outer-xs">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"
                                        name="remember">{{ __('system.remember_me') }}!
                                </label>
                                <a href="{{ route('password.request') }}" class="forgot-password pull-right">{{ __('system.forgot_password')}}?</a>
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __('system.login') }}</button>
                        </form>
                    </div>
                    <!-- Sign-in -->

                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">{{ __('system.create_account') }}</h4>
                        <p class="text title-tag-line">{{ __('system.create_account') }}.</p>
                        <form class="register-form outer-top-xs" role="form" method="post"
                            action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">{{ __('system.email_address') }} <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input"
                                    id="email"name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">{{ __('system.name') }} <span>*</span></label>
                                <input type="name" class="form-control unicase-form-control text-input" id="name"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">{{ __('system.phone_number') }} <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input"
                                    id="exampleInputEmail1" name="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">{{ __('system.password') }} <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input" name="password">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">{{ __('system.confirm_password') }} <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="exampleInputEmail1" name="password_confirmation">
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __('system.signup') }}</button>
                        </form>


                    </div>
                    <!-- create a new account -->
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('customers.sections.brands')



        </div><!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
    </div><!-- /.body-content -->


@endsection
