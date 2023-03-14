@extends('admin.layouts.admin_master')
@section('title')
   Change password
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="container-full">
        <!-- Main content -->
        <div class="container-full">
            <!-- Main content -->
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">{{ __('system.change_password_form') }}</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{route('admin.update.password')}}" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>{{ __('system.current_password') }} <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="password" name="oldpassword" class="form-control"
                                                                   required="" id="current_password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>{{ __('system.new_password') }} <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="password" name="password" class="form-control"
                                                                   required="" id="current_password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>{{ __('system.confirm_new_password') }} <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="password" name="password_confirmation" class="form-control"
                                                                   required="" id="password_confirmation">
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>


                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                       value="{{ __('system.update') }}">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>

@endsection

