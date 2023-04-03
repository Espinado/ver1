@extends('admin.layouts.admin_master')
@section('title')
    {{ __('system.processing_orders') }}
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
                            <h3 class="box-title"> {{ __('system.processing_orders') }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center"> {{ __('system.date') }}</th>
                                            <th style="text-align: center"> {{ __('system.invoice') }}</th>
                                             <th style="text-align: center"> {{ __('system.amount') }}</th>
                                            <th style="text-align: center"> {{ __('system.payment') }}</th>
                                            <th style="text-align: center"> {{ __('system.status') }}</th>
                                             <th style="text-align: center"> {{ __('system.action') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>

                                                <td style="text-align: center">{{$order->order_date}}</td>
                                                <td style="text-align: center">{{$order->invoice_no}}</td>
                                                 <td style="text-align: center">{{$order->amount}}&nbsp;EUR</td>
                                                  <td style="text-align: center">{{$order->payment_method}}</td>
                                                  <td style="text-align: center"><span class="badge badge-pill badge-primary">{{__('system.' . App\Enums\OrderStatus::getKey(intval($order->status)))}}</span></td>
                                                    <td style="text-align: center">
                                                         <a href="{{ route('admin.processing.orders.details',$order->id ) }}" class="btn btn-sm btn-primary"><i
                                                            class="fa fa-eye"></i> </a>

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


            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
