@extends('customers.layouts.app')
@section('content')
@section('page_title')
    {{ __('system.login') }}
@endsection
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    @php
        use App\Models\Admins\ShipDivision;
        use App\Models\Admins\ShipDistrict;
        $divisions = ShipDivision::all();
        $districts = ShipDistrict::all();

    @endphp
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">{{ __('system.home') }}</a></li>
                    <li class='active'>{{ __('auth.login') }}</li>
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
                                <label class="info-title" for="exampleInputEmail1">{{ __('system.email_address') }}
                                    <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input"
                                    id="exampleInputEmail1" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">{{ __('system.password') }}
                                    <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="exampleInputPassword1" name="password">
                            </div>
                            <div class="radio outer-xs">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"
                                        name="remember">{{ __('system.remember_me') }}!
                                </label>
                                <a href="{{ route('password.request') }}"
                                    class="forgot-password pull-right">{{ __('system.forgot_password') }}?</a>
                            </div>
                            <button type="submit"
                                class="btn-upper btn btn-primary checkout-page-button">{{ __('system.login') }}</button>
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
                                <label class="info-title" for="exampleInputEmail2">{{ __('system.email_address') }}
                                    <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input"
                                    id="email"name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">{{ __('system.name') }}
                                    <span>*</span></label>
                                <input type="name" class="form-control unicase-form-control text-input" id="name"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">{{ __('system.surname') }}
                                    <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="surname"
                                    name="surname" value="{{ old('surname') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5><b>{{ __('system.country') }}</b><span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="division_id" class="form-control" id="division">
                                        <option value=""><b>Select country</b></option>
                                        @foreach ($divisions as $div)
                                            <option value="{{ $div->id }}"
                                                @if (old('division_id') == $div->id) selected @endif>
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
                                <h5><b>{{ __('system.city') }}</b><span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="district_id" class="form-control" id="district">
                                        <option value=""><b>Select city</b></option>
                                        @foreach ($districts as $dis)
                                            <option value="{{ $dis->id }}"
                                                @if (old('district_id') == $dis->id) selected @endif>
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
                                <label class="info-title" for="exampleInputEmail1">{{ __('system.phone_number') }}
                                    <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input"
                                    id="exampleInputEmail1" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">{{ __('system.password') }}
                                    <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    name="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">{{ __('system.confirm_password') }}
                                    <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="exampleInputEmail1" name="password_confirmation">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit"
                                class="btn-upper btn btn-primary checkout-page-button">{{ __('system.signup') }}</button>
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

   <script type="text/javascript">
    $(document).ready(function() {
        $('#division').select2({
            placeholder: 'Select country',
            language: "fr",
            theme: "classic"
        });

        $('#district').select2({
            placeholder: 'Select city',
            language: "fr",
            theme: "light"
        });

        var tmp = $('select[name="division_id"]').val();
        if (tmp) {
            $('select[name="district_id"]').html('');
            $.ajax({
                url: "{{ url('/division/district/ajax/') }}/" + tmp,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="district_id"]').append(
                        '<option value="" disabled="" selected="">Select it</option>'
                    );

                    $.each(data, function(key, value) {
                        $('select[name="district_id"]').append(
                            '<option value="' + value.id + '">' + value.district_name + '</option>'
                        );
                    });

                    var oldValue = "{{ old('district_id') }}";
                    $('select[name="district_id"]').val(oldValue);
                },
            });
        }

        $('select[name="division_id"]').on('change', function() {
            var division_id = $(this).val();
            if (division_id) {
                $('select[name="district_id"]').html('');
                $.ajax({
                    url: "{{ url('/division/district/ajax/') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="district_id"]').append(
                            '<option value="" disabled="" selected="">Select it</option>'
                        );

                        $.each(data, function(key, value) {
                            $('select[name="district_id"]').append(
                                '<option value="' + value.id + '">' + value.district_name + '</option>'
                            );
                        });
                    },
                });
            }
        });
    });
</script>
@endsection
