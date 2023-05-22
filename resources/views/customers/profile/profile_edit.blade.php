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


                <div class="col-md-2"><br><br>
                </div>

                <div class="col-md-6"><br><br>
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Hi, {{ $user->name }}!, update your
                                profile</span></h3>
                        <div class="card-body">
                            <form method="post" action="{{ route('user.profile.update')}}" enctype="multipart/form-data">
                                @csrf

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">{{ __('system.name') }} </label>
                                <input type="text" class="form-control unicase-form-control text-input"
                                    id="name"name="name" value="{{$user->name}}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">{{ __('system.surname') }} </label>
                                <input type="text" class="form-control unicase-form-control text-input"
                                    id="surname"name="surname" value="{{$user->surname}}">
                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">{{ __('system.email') }}</label>
                                <input type="email" class="form-control unicase-form-control text-input"
                                    name="email" value="{{$user->email}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">{{ __('system.phone_number') }}</label>
                                <input type="phone" class="form-control unicase-form-control text-input"
                                    name="phone" value="{{$user->phone}}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">{{ __('system.image') }}</label>
                                <input type="file" class="form-control unicase-form-control text-input"
                                    name="profile_image" id="image" >
                            </div>
                            <div class="form-group">
                               <button type="submit" class="btn btn-danger">{{ __('system.update') }}</button>
                            </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader=new FileReader();
                reader.onload=function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
                    })
        })

    </script>

@endsection
