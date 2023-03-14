@extends('admin.layouts.admin_master')
@section('title')
    {{ __('system.edit_profile') }}
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
                        <h4 class="box-title">{{ __('system.edit_profile') }}</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{route('admin.profile.update')}}" enctype="multipart/form-data">
                                    @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{ __('system.name') }} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control"
                                                               required="" value="{{$adminProfileData->name}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Email Field <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="email" name="email" class="form-control"
                                                               required="" value="{{$adminProfileData->email}}">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Profile image <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="profile_photo_path"
                                                               class="form-control" required=""
                                                               id="image">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <img
                                                    src="{{ $adminProfileData->profile_photo_path ? url('admin_images/'.$adminProfileData->profile_photo_path):  url('no_image.jpg')}}"
                                                    style="width: 100px; height: 100px;" alt="User Avatar"
                                                    id="imagePreview">
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
