@extends('admin.layouts.admin_master')
@section('title')
    {{ __('system.confirmed_orders') }}
@endsection
@section('content')
 {{-- @php
        $user = Auth::user();
    @endphp --}}

    <div class="body-content">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-2"><br><br>
                    <img class="card-img-top" style="border-radius: 50%"
                        src="{{ $user->profile_photo_path ? url('user_images/' . $user->profile_photo_path) : url('no_image.jpg') }}"
                        height="100%" width="100%"><br><br>
                    @include('customers.profile.includes.menu')
                </div> --}}
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('system.order_details') }}</h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC;">
                            <table class="table">
                                <tr>
                                    <th> {{ __('system.shipping_name') }} : </th>
                                    <th> {{ $order->name }} </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.shipping_phone') }} : </th>
                                    <th> {{ $order->phone }} </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.shipping_email') }} : </th>
                                    <th> {{ $order->email }} </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.division') }} : </th>
                                    <th> {{ $order->division->division_name }} </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.district') }} : </th>
                                    <th> {{ $order->district->district_name }} </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.state') }} : </th>
                                    @if($order->state)
                                    <th>{{ $order->state->state_name }} </th>
                                    @endif
                                </tr>

                                <tr>
                                    <th> {{ __('system.shipping_postcode') }} : </th>
                                    <th> {{ $order->post_code }} </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.order_date') }} : </th>
                                    <th> {{ $order->order_date }} </th>
                                </tr>


                            </table>


                        </div>

                    </div>

                </div> <!-- // end col md -5 -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                <span class="text-danger"> Invoice : {{ $order->invoice_no }}</span>
                            </h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC;">
                            <table class="table">
                                <tr>
                                    <th> {{ __('system.username') }} : </th>
                                    <th> {{ $order->user->name }} </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.phone') }}: </th>
                                    <th> {{ $order->user->phone }} </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.payment_method') }}: </th>
                                    <th> {{ $order->payment_method }} </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.transaction_id') }} : </th>
                                    <th> {{ $order->transaction_id }} </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.invoice_no') }}: </th>
                                    <th> <span class="text-danger">{{ $order->invoice_no }} </span></th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.total') }} : </th>
                                    <th>{{ $order->amount }} EUR </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.order_date') }}: </th>
                                    <th> {{ $order->order_date }} </th>
                                </tr>

                                <tr>
                                    <th> {{ __('system.status') }} : </th>
                                    <th> <span class="badge badge-pill badge-warning"
                                            style="background: #418DB9;">{{__('system.' . App\Enums\OrderStatus::getKey(intval($order->status)))}} </span> </th>
                                </tr>
                                <th></th>
                                    <th><a href="{{route('admin.toProcess.order', $order->id)}}" class="btn btn-clock btn-success">To process</a></th>

                            </table>


                        </div>

                    </div>

                </div> <!-- // end col md -5 -->
            </div>
            <div class="col-md-12">

                <div class="table-responsive">
                    <table class="table">
                        <tbody>

                            <tr style="background: #e2e2e2;">
                                <td class="col-md-1">
                                    <label for=""> Image</label>
                                </td>

                                <td class="col-md-3">
                                    <label for=""> Product Name </label>
                                </td>

                                <td class="col-md-3">
                                    <label for=""> Product Code</label>
                                </td>


                                <td class="col-md-2">
                                    <label for=""> Color </label>
                                </td>

                                <td class="col-md-2">
                                    <label for=""> Size </label>
                                </td>

                                <td class="col-md-1">
                                    <label for=""> Quantity </label>
                                </td>

                                <td class="col-md-4">
                                    <label for=""> Price </label>
                                </td>
                                <td class="col-md-4">
                                    Total price
                                </td>

                            </tr>


                            @foreach ($orderItem as $item)
                                <tr>
                                    <td class="col-md-1">
                                        <label for=""><img src="{{ asset($item->product->product_thambnail) }}"
                                                height="50px;" width="50px;"> </label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> {{ $item->product->product_name }}</label>
                                    </td>


                                    <td class="col-md-3">
                                        <label for=""> {{ $item->product->product_code }}</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for=""> {{ $item->color }}</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for=""> {{ $item->size }}</label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for=""> {{ $item->qty }}</label>
                                    </td>

                                    <td class="col-md-4">
                                        EUR {{ $item->price }}
                                    </td>
                                    <td>
                                        EUR {{ $item->price * $item->qty }}
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div> <!-- / end col md 8 -->

        </div> <!-- // END ORDER ITEM ROW -->

    </div>

@endsection
