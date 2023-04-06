@extends('customers.layouts.app')
@section('content')
@section('title')
    {{ __('system.profile') }}
@endsection
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
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
                                            <form class="register-form" action="{{ route('shipping.info.update') }}"
                                                method="POST">
                                                @csrf
                                                <div class="col-md-6 col-sm-6 already-registered-login">
                                                    <h4 class="checkout-subtitle"><b>{{ __('system.shipping_address') }}</b>
                                                    </h4>


                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="exampleInputEmail1"><b>{{ __('system.name') }}</b>
                                                            <span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" name="name" placeholder="Name"
                                                            value="{{ $user['user_profile']['name'] }}">
                                                        @error('name')
                                                            <span class="text-danger"><b>{{ $message }}</b></span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="exampleInputEmail1"><b>{{ __('system.surname') }}</b>
                                                            <span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" name="surname" placeholder="Surname"
                                                            value="{{ $user['user_profile']['surname'] }}">
                                                        @error('surname')
                                                            <span class="text-danger"><b>{{ $message }}</b></span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="exampleInputEmail1"><b>{{ __('system.shipping_email') }}</b>
                                                            <span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" name="email" placeholder="Email"
                                                            value="{{ $user['user_profile']['email'] }}">
                                                        @error('email')
                                                            <span class="text-danger"><b>{{ $message }}</b></span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="exampleInputEmail1"><b>{{ __('system.shipping_phone') }}</b>
                                                            <span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" name="phone" placeholder="Phone"
                                                            value="{{ $user['user_profile']['phone'] ? $user['user_profile']['phone'] : '' }}">
                                                        @error('phone')
                                                            <span class="text-danger"><b>{{ $message }}</b></span>
                                                        @enderror
                                                    </div>


                                                </div>

                                                <!-- already-registered-login -->

                                                <!-- already-registered-login -->
                                                <div class="col-md-6 col-sm-6 already-registered-login">

                                                    <div class="form-group">
                                                        <h5><b>{{ __('system.division') }}</b><span
                                                                class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="division_id" class="form-control" id="division">
                                                                <option
                                                                    value="{{ $user->user_profile->division ? $user->user_profile->division->id : '' }}">
                                                                    <b>{{ $user->user_profile->division ? $user->user_profile->division->division_name : '' }}</b>
                                                                </option>
                                                                @foreach ($divisions as $div)
                                                                    <option value="{{ $div->id }}">
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
                                                        <h5><b>{{ __('system.district') }}</b> <span
                                                                class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select id="district" name="district_id" class="form-control">
                                                                <option
                                                                    value="{{ $user->user_profile->district ? $user->user_profile->district->id : '' }}">
                                                                    <b>{{ $user->user_profile->district ? $user->user_profile->district->district_name : '' }}</b>
                                                                </option>
                                                                @foreach ($districts as $dis)
                                                                    <option value="{{ $dis->id }}">
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
                                                        <h5>{{ __('system.state') }} <span class="text-danger">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <select name="state_id" class="form-control" id="state">

                                                                @if ($user['user_profile']['state'])
                                                                    <option
                                                                        value="{{ $user['user_profile']['state']['id'] ? $user['user_profile']['state']['id'] : 'null' }}"
                                                                        selected="" disabled="">
                                                                        <b>{{ $user['user_profile']['state']['state_name'] ? $user['user_profile']['state']['state_name'] : '' }}</b>
                                                                    </option>
                                                                @else
                                                                    <option value="">
                                                                        <b>State not defined</b>
                                                                    </option>
                                                                @endif


                                                            </select>
                                                            @error('state_id')
                                                                <span class="text-danger"><b>{{ $message }}</b></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="exampleInputEmail1"><b>{{ __('system.postcode') }}</b>
                                                            <span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" name="postcode" placeholder="Postcode"
                                                            value="{{ $user['user_profile']['postcode'] ? $user['user_profile']['postcode'] : '' }}">
                                                        @error('postcode')
                                                            <span class="text-danger"><b>{{ $message }}</b></span>
                                                        @enderror
                                                    </div>



                                                </div>
                                        </div class="row">
                                        <hr>
                                        <!-- already-registered-login -->

                                    </div>
                                    <!-- panel-body  -->


                                </div><!-- row -->
                                <button type="submit"
                                    class="btn-upper btn btn-primary checkout-page-button">{{ __('system.update') }}</button>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#district').select2({
                placeholder: 'Select district',
                language: "fr",
                theme: "classic"
            });
            $('#division').select2({
                placeholder: 'Select division',
                language: "fr",
                theme: "classic"
            });
            $('#state').select2({
                placeholder: 'Select division',
                theme: "classic",
                language: "fr"
            });
            $('#division').on('change', function() {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: "{{ url('/division/district/ajax') }}/" + division_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="district_id"]').html('');
                            $('select[name="state_id"]').html('');
                            $('select[name="district_id"]').append(
                                '<option value="" disabled="" selected="">Select it</option>'
                            );
                            $('select[name="state_id"]').append(
                                '<option value="" disabled="" selected="">Select it</option>'
                            );
                            $.each(data, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .district_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            })
            $('select[name="district_id"]').on('change', function() {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: "{{ url('/get/states/ajax') }}/" + district_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="state_id"]').html('');
                            $('select[name="state_id"]').append(
                                '<option value="" disabled="" selected="">Select it</option>'
                            );
                            $.each(data, function(key, value) {
                                $('select[name="state_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .state_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        })
    </script>
@endsection
