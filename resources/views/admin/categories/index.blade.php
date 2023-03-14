@extends('admin.layouts.admin_master')
@section('title')
   {{ __('system.dashboard') }}
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-6">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Category list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Category name</th>
                                            <th style="text-align: center">Icon</th>
                                            <th style="text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td style="text-align: center">{{ $category->category_name }}</td>
                                                <td style="text-align: center"><i class="{{ $category->icon }} "></i></td>
                                                <td style="text-align: center">
                                                    <a href="{{ route('admin.category.edit', $category->id) }}"
                                                        class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{ route('admin.category.delete', $category->id) }}"
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

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('admin.category.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                        <div class="form-group">
                                            <h5>Category name-{{ $locale['native'] }} <span class="text-danger">*</span>
                                            </h5>
                                            <div class="controls">
                                                <input type="text" name="category_name[{{ $key }}]]"
                                                    class="form-control" id="category_name"
                                                    value="{{ old('category_name.' . $key) }}">
                                                @error("category_name.{$key}")
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <h5>Category icon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="category_icon" class="form-control"
                                                id="category_icon">
                                            @error('category_icon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Save">
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
@endsection
