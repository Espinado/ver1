@extends('admin.layouts.admin_master')
@section('title')
    Dashboard
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit slide</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('admin.slider.update', $slider->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $slider->id }}">
                                    <input type="hidden" name="old_image" value="{{$slider->slider_img}}">

                                    <div class="form-group">
                                        <h5>Slider title <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="slider_title" class="form-control" id="slider_title" value="{{$slider->title}}">
                                            @error('slider_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Slider description <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="slider_decription" class="form-control" id="slider_title" value="{{$slider->description}}">
                                            @error('slider_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Slider image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="slider_image" class="form-control" id="slider_image">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="widget-user-image">
                                            <img class="rounded-circle" src="{{ $slider->slider_img ? url($slider->slider_img):  url('no_image.jpg')}}"
                                                style="width:100px; height:80px;" alt="User Avatar" id="slider_image_preview">

                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#slider_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#slider_image_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            })
        })
    </script>
@endsection
