<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('system.invoice') }}</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: green;
            ;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <img src="{{ public_path('products/trumbnails/1760175001408710.jpg') }}" alt="" width="150"/>
                <h2 style="color: green; font-size: 26px;"><strong>RvRShop</strong></h2>
            </td>
            <td align="right">
                <pre class="font">
               RvR
               {{ __('system.email') }}:rvr@arguss.lv <br>


            </pre>
            </td>
        </tr>

    </table>


    <table width="100%" style="background:white; padding:2px;""></table>

    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>{{ __('system.name') }}:</strong> {{ $order->user->name }} <br>
                    <strong>{{ __('system.email') }}:</strong> {{ $order->user->email }} <br>
                    <strong>{{ __('system.phone') }}:</strong> {{ $order->user->phone }} <br>

                    <strong>{{ __('system.address') }}:</strong> {{ $order->district->district_name }} <br>
                    <strong>{{ __('system.postcode') }}:</strong> {{ $order->shipping_postcode }}
                </p>
            </td>
            <td>
                <p class="font">
                <h3><span style="color: green;">{{ __('system.invoice') }}:</span> #{{ $order->invoice_no }}</h3>
                {{ __('system.order_date') }}: {{ $order->order_date }} <br>
                {{ __('system.delivery_date') }}: Delivery Date <br>
                {{ __('system.payment_method') }} : {{ $order->payment_method }} </span>
                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>Products</h3>


    <table width="100%">
        <thead style="background-color: green; color:#FFFFFF;">
            <tr class="font">
                <th>{{ __('system.preview') }}</th>
                <th>{{ __('system.product_name') }}</th>
                <th>{{ __('system.size') }}</th>
                <th>{{ __('system.color') }}</th>
                <th>{{ __('system.product_code') }}</th>
                <th>{{ __('system.quantity') }}</th>
                <th>{{ __('system.unit_price') }} </th>
                <th>{{ __('system.tax_rate') }}</th>
                <th>{{ __('system.tax_amount') }}</th>
                <th>{{ __('system.total') }} </th>
            </tr>
        </thead>
        <tbody>

 @foreach ($orderItem as $item)
            <tr class="font">

                    <td align="center">
                        <img src="{{ public_path($item->product->product_thambnail) }}" height="60px;" width="60px;"
                            alt="">
                    </td>

                    <td align="center">{{ $item->product->product_name }}</td>
                    <td align="center">
                        {{ $item->product->product_size }}
                    </td>
                    <td align="center"> {{ $item->product->product_color_en }}</td>
                    <td align="center"> {{ $item->product->product_code }}</td>
                    <td align="center">{{$item->qty}}</td>
                    <td align="center"> {{$item->price * ((100-21) / 100)}}  EUR</td>
                    <td align="center"> 21%</td>
                    <td align="center"> {{$item->price/100*21 }}  EUR</td>
                    <td align="center">{{$item->price * $item->qty}} EUR</td>

            </tr>
             @endforeach

        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: green;">{{ __('system.without_vat') }}:</span> {{$order->amount * ((100-21) / 100)}} EUR</h2>
                <h2><span style="color: green;">{{ __('system.vat') }}:</span> {{$order->amount/100*21}} EUR</h2>
                <h2><span style="color: green;">{{ __('system.total') }}:</span> {{$order->amount}} EUR </h2>
                {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
            </td>
        </tr>
    </table>
    <div class="thanks mt-3">
        <p>{{ __('system.thank_you') }}!!</p>
    </div>
    <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5>Authority Signature:</h5>
    </div>
</body>

</html>
