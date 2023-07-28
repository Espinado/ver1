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
                            <h3 class="box-title">User list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Image</th>
                                            <th style="text-align: center">Name</th>
                                            <th style="text-align: center">Email</th>
                                            <th style="text-align: center">Phone</th>
                                            <th style="text-align: center">Status</th>
                                            <th style="text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                 <td style="text-align: center">
                                                    <img src="{{!empty($user->profile_photo_path) ? url('user_images/'.$user->profile_photo_path ): url('no_image.jpg')}}"
                                                    style="width:70px; height:40px"> </td>
                                                <td style="text-align: center">{{ $user->name }}&nbsp{{ $user->surname }}</td>
                                                <td style="text-align: center">{{$user->email}}</td>
                                                <td style="text-align: center">{{$user->phone}}</td>
                                                <td style="text-align: center">{{$user->last_seen_at}}</td>
                                                <td style="text-align: center">
                                                    <a href="{{ route('admin.brand.edit', $user->id) }}"
                                                        class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{ route('admin.brand.delete', $user->id) }}"
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


                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

@endsection
