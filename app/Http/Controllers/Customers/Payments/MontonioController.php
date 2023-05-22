<?php

namespace App\Http\Controllers\Customers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use Gloudemans\Shoppingcart\Facades\Cart;
use Firebase\JWT\JWT;
use \Firebase\JWT\Key;


class MontonioController extends Controller
{
    public function proceedToPayment(Request $request) {
        $data = json_decode($request->input('data'), true);
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        $payload = [
            'accessKey'         => config('app.montonio.access'),
            'merchantReference' => md5(rand()),
            'returnUrl'         =>  route('after', ['data' => $data]),
            'notificationUrl'   => route('product.afterpayment.notification'),
            'currency'          => 'EUR',

            'grandTotal'        => $data['GrandTotal'],

            'locale'            => 'lv',
            'billingAddress'    => [
                'firstName'    =>  $data['shipping_name'],
                'email'        => $data['shipping_email'],
                'addressLine1' => 'Kai 1',
                'locality'     => $data['district_id'],
                // 'region'       =>'aaaa',
                'country'      => $data['division_id'],
                'postalCode'   => $data['post_code'],
                'phoneNumber' => $data['shipping_phone'],

            ],
            'shippingAddress'   => [
                'firstName'    => $data['shipping_name'],
                'email'        => $data['shipping_email'],
                'addressLine1' => 'Kai 1',
                'locality'     => $data['district_id'],
                // 'region'       => $request->state_id,
                'country'      => $data['division_id'],
                'postalCode'   => $data['post_code'],
                'phoneNumber' => $data['shipping_phone'],
            ],
            'lineItems'         => [],
        ];
        $carts = Cart::content();
        foreach ($carts as $cart) {
            $lineItem = [
                'name'       => $cart->name,
                'quantity'   => intval($cart->qty),
                'finalPrice' => $data['GrandTotal'],
            ];
            array_push($payload['lineItems'], $lineItem);
            // dd($payload['lineItems']);
        }
        $payload['payment'] = [
            'method'        => 'paymentInitiation',
            'methodDisplay' => 'Pay with your bank',
            'amount'        => $data['GrandTotal'],
            'currency'      => 'EUR', // This must match the currency of the order.
            // 'orderNumber' =>  'RvR-' . substr(md5(rand()), 0, 10),
            // 'invoice_number' => 'RvR' . mt_rand(10000000, 99999999),
            'methodOptions' => [
                'paymentReference'   => $data['order_no'],
                'paymentDescription' => $data['order_no'],
                'preferredCountry'   => 'LV',

            ],
        ];
        // add expiry to payment data for JWT validation
        $payload['exp'] = time() + (10 * 60);

        // 3. Generate the token using Firebase's JWT library
        $token = JWT::encode($payload, config('app.montonio.secret'), 'HS256');

        // 5. Get the payment URL
        $client = new Client();
        $response = $client->post('https://sandbox-stargate.montonio.com/api/orders', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'body' => $token
            ]
        ]);
        $result = $response->getBody()->getContents();
        $data = json_decode($result, true);
        return redirect()->away($data['paymentUrl']);

    }
}
