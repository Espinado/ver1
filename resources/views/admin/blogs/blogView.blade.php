@extends('admin.layouts.admin_master')
@section('title')
    Blogs
@endsection
@section('content')
<div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Blogs</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Title</th>
                                             <th style="text-align: center">Image</th>
                                            <th style="text-align: center">Short blog</th>
                                            <th style="text-align: center">Full blog</th>
                                            <th style="text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $blog)
                                            <tr>
                                                <td style="text-align: center">{{ $blog->title }}</td>

                                                <td style="text-align: center"><img src="{{ asset($blog->image) }}"
                                                        style="width: 70px"; height="40px";></td>
                                                        <td style="text-align: center">{!! $blog->short_blog !!}</td>
                                                        <td style="text-align: center">{!! $blog->full_blog !!}</td>
                                                <td style="text-align: center">
                                                    <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                                        class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{ route('admin.blog.delete', $blog->id) }}"
                                                        class="btn btn-danger" id="delete" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
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

                <div class="col-6">

                    {{-- <div class="box">
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
                    </div> --}}
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
