@extends('admin.layouts.admin_master')
@section('title')
    FAQ
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
                            <h3 class="box-title">FAQ</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Question</th>
                                             <th style="text-align: center">Answer</th>
                                             <th style="text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faqs as $faq)
                                            <tr>
                                                <td style="text-align: center">{{ $faq->question }}</td>
                                                <td style="text-align: center">{!! $faq->answer !!}</td>
                                                <td style="text-align: center">
                                                    <a href="{{ route('admin.faq.edit', $faq->id) }}"
                                                        class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{ route('admin.faq.delete', $faq->id) }}"
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

                
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
