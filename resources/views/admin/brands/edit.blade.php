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
                            <h3 class="box-title">Edit brand</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('admin.brand.update', $brand->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $brand->id }}">
                                    <input type="hidden" name="old_image" value="{{$brand->brand_logo}}">

                                    <div class="form-group">
                                        <h5>Brand name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="brand_name" class="form-control" id="brand_name" value="{{$brand->brand_name}}">
                                            @error('brand_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Brand logo <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="brand_logo" class="form-control" id="brand_logo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="widget-user-image">
                                            <img class="rounded-circle" src="{{ $brand->brand_logo ? url($brand->brand_logo):  url('no_image.jpg')}}"
                                                style="width:70px; height:40px;" alt="User Avatar" id="brand_logo_preview">

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
            $('#brand_logo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#brand_logo_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            })
        })
    </script>
@endsection
