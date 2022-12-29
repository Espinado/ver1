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
                            <h3 class="box-title">Edit subcategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('admin.subcategory.update', $subcategory->id) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$subcategory->id}}">
                                    <div class="form-group">
                                        <h5>Subcategory name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name" class="form-control" id="subcategory_name" value="{{$subcategory->subcategory_name}}">
                                            @error('subcategory_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Subcategory icon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_icon" class="form-control"
                                                id="subcategory_icon" value="{{$subcategory->icon}}">
                                                 @error('subcategory_icon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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

@endsection
