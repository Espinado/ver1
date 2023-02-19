@extends('admin.layouts.admin_master')
@section('content')
@section('title')
    Ship divisions
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">



            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Divisions List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Division Name </th>
                                        <th>Status </th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($divisions as $division)
                                        <tr>
                                            <td> {{ $division->division_name }} </td>


                                            <td>
                                                @if ($division->status == true)
                                                    <span class="badge badge-pill badge-success">Active </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"> Inactive </span>
                                                @endif
                                            </td>

                                            <td width="40%">
                                                <a href="{{ route('admin.division.edit', $division->id) }}"
                                                    class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="{{ route('admin.division.delete', $division->id) }}"
                                                    class="btn btn-danger" title="Delete Data" id="delete">
                                                    <i class="fa fa-trash"></i></a>
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


            </div>
            <!-- /.col -->


            <!--   ------------ Add Coupon Page -------- -->


            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add division </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form method="post" action="{{ route('admin.division.store') }}">
                                @csrf
                                <div class="form-group">
                                    <h5>Division Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="division_name" class="form-control">
                                        @error('division_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>




@endsection
