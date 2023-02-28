@extends('customers.layouts.app')
@section('content')
@section('title')
    {{ __('system.profile') }}
@endsection
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"><br><br>
                    <img class="card-img-top" style="border-radius: 50%"
                        src="{{ $user->profile_photo_path ? url('user_images/' . $user->profile_photo_path) : url('no_image.jpg') }}"
                        height="100%" width="100%"><br><br>
                    @include('customers.profile.includes.menu')
                </div>


                <div class="col-md-2"><br><br>
                </div>

                <div class="col-md-6"><br><br>
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Hi, {{ $user->name }}!</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
