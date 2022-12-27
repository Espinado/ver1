@extends('customers.layouts.app')
@section('content')
@section('page_title')
    Login
@endsection
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li class='active'>Reset password</li>
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
                        <h4 class="">Reset password</h4>


                        <form class="register-form outer-top-xs" role="form" method="POST"
                            action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{$request->route('token')}}">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input"
                                    id="email" name="email" value="{{old('email')}}" >
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">New password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="password" name="password" >
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm new password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="password_confirmation" name="password_confirmation"">
                            </div>


                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update password</button>
                        </form>
                    </div>
                    <!-- Sign-in -->


                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('customers.sections.brands')



        </div><!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
    </div><!-- /.body-content -->


@endsection
