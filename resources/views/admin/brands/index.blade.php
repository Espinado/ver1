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

                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Brand list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Brand name</th>
                                            <th style="text-align: center">Logo</th>
                                            <th style="text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $brand)
                                            <tr>
                                                <td style="text-align: center">{{ $brand->brand_name }}</td>
                                                <td style="text-align: center"><img src="{{ asset($brand->brand_logo) }}" style="width: 70px";
                                                        height="40px";></td>
                                                <td style="text-align: center">
                                                    <a href="{{route('admin.brand.edit', $brand->id)}}" class="btn btn-info">Edit</a>
                                                    <a href="{{route('admin.brand.delete', $brand->id)}}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>

                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add brand</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('admin.brand.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Brand name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="brand_name" class="form-control" id="brand_name">
                                            @error('brand_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Brand logo <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="brand_logo" class="form-control" required=""
                                                id="brand_logo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="widget-user-image">
                                            <img class="rounded-circle" src="{{ url('no_image.jpg') }}"
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
