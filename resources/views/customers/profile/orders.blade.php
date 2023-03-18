@extends('customers.layouts.app')
@section('content')
@section('title')
    {{ __('system.profile') }}
@endsection
@section('content')
    @php
        $user = Auth::user();
    @endphp
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"><br><br>
                    <img class="card-img-top" style="border-radius: 50%"
                        src="{{ $user->profile_photo_path ? url('user_images/' . $user->profile_photo_path) : url('no_image.jpg') }}"
                        height="100%" width="100%"><br><br>
                    @include('customers.profile.includes.menu')
                </div>
                <div class="col-md-10"><br><br>
                    <div class="card">

                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table" id="datatable1">
                                    <tbody>

                                        <tr style="background: #e2e2e2;">
                                            <td class="col-md-3">
                                                <label for="">{{ __('system.date') }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for=""> {{ __('system.total') }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for=""> {{ __('system.payment') }}</label>
                                            </td>


                                            <td class="col-md-2">
                                                <label for=""> {{ __('system.invoice') }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for=""> {{ __('system.order') }}</label>
                                            </td>

                                            <td class="col-md-3">
                                                <label for=""> {{ __('system.action') }} </label>
                                            </td>

                                        </tr>

                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="col-md-1">
                                                    <label for=""> {{ $order->order_date }}</label>
                                                </td>

                                                <td class="col-md-3">
                                                    <label for=""> ${{ $order->amount }}</label>
                                                </td>

                                                <td class="col-md-3">
                                                    <label for=""> {{ $order->payment_method }}</label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for=""> {{ $order->invoice_no }}</label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">
                                                        <span class="badge badge-pill badge-warning"
                                                            style="background: #418DB9;">{{__('system.' . App\Enums\OrderStatus::getKey(intval($order->status)))}} </span>

                                                    </label>
                                                </td>

                                                <td class="col-md-1">
                                                    <a href="{{ route('user.order.details',$order->id ) }}" class="btn btn-sm btn-primary"><i
                                                            class="fa fa-eye"></i> {{ __('system.view') }}</a>

                                                    <a href="{{ route('user.order.invoice',$order->id ) }}" class="btn btn-sm btn-danger" style="margin-top: 5px"><i
                                                            class="fa fa-download" style="color: white;"></i> {{ __('system.invoice') }} </a>

                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                                {{ $orders->links() }}

                            </div>

                        </div> <!-- / end col md 8 -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
