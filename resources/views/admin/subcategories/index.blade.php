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

                <div class="col-6">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Subcategory list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Subcategory name</th>
                                            <th style="text-align: center">Category name</th>
                                            <th style="text-align: center">Icon</th>
                                            <th style="text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($subcategories as $subcategory)
                                            <tr>
                                                <td style="text-align: center">{{ $subcategory->subcategory_name }}</td>
                                                <td style="text-align: center">
                                                    {{ $subcategory['category']['category_name'] }}</td>
                                                <td style="text-align: center"><i class="{{ $subcategory->icon }} "></i>
                                                </td>
                                                <td style="text-align: center; width:30%">
                                                    <a href="{{ route('admin.subcategory.edit', $subcategory->id) }}"
                                                        class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{ route('admin.subcategory.delete', $subcategory->id) }}"
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
                            <h3 class="box-title">Add subcategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('admin.subcategory.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                        <div class="form-group">
                                            <h5>Subcategory name-{{ $locale['native'] }} <span class="text-danger">*</span>
                                            </h5>
                                            <div class="controls">
                                                <input type="text" name="subcategory_name[{{ $key }}]]"
                                                    class="form-control" id="subcategory_name"
                                                    value="{{ old('subcategory_name.' . $key) }}">
                                                @error("subcategory_name.{$key}")
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach


                                    <div class="form-group">
                                        <h5>Subategory icon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_icon" class="form-control"
                                                id="category_icon" value="{{ old('subcategory_icon') }}">
                                            @error('subcategory_icon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <select class="form-control" id="select" name="category_id">
                                                <option value="" selected="" disabled="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
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
