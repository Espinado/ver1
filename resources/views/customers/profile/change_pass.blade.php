@extends('customers.layouts.app')
@section('content')
@section('page_title')
    Login
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"><br><br>
                    <img class="card-img-top" style="border-radius: 50%"
                        src="{{ $user->profile_photo_path ? url('user_images/' . $user->profile_photo_path) : url('no_image.jpg') }}"
                        height="100%" width="100%" id="imagePreview"><br><br>
                    @include('customers.profile.includes.menu')
                </div>

                <div class="col-md-6"><br><br>
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Hi, {{ $user->name }}!, update your
                                password</span></h3>
                        <div class="card-body">
                            <form method="post" action="{{ route('user.update.password')}}">
                                @csrf

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Old Password </label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="current_password"name="oldpassword">

                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">New password</label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    name="password" id="password">

                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Confirm new password</label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    name="password_confirmation" id="password_confirmation" >

                            </div>

                            <div class="form-group">
                               <button type="submit" class="btn btn-danger">Update</button>
                            </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
