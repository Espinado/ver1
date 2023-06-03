<?php

namespace App\Http\Controllers\Customers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use Gloudemans\Shoppingcart\Facades\Cart;
use Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use GuzzleHttp\Exception\RequestException;
use App\Models\Customers\Order;
use App\Models\Customers\OrderItem;
use App\Helpers\newOrder;
use Auth;


class MontonioController extends Controller
{

    private $data;

    public function __construct(Request $request)
    {
        $this->data = json_decode($request->input('data'), true);
    }


    public function proceedToPayment(Request $request) {
        $data = json_decode($request->input('data'), true);
// dd($data);


        $payload = [
            'accessKey'         => config('app.montonio.access'),
            'merchantReference' => md5(rand()),
            'returnUrl'         =>  route('after'),
            'notificationUrl'   => route('product.afterpayment.notification'),
            'currency'          => 'EUR',
            'grandTotal'        => $data['GrandTotal'],
            'locale'            => 'lv',
            'billingAddress'    => [
                'firstName'    =>  $this->data['shipping_name'],
                'email'        => $this->data['shipping_email'],
                'addressLine1' => 'Kai 1',
                'locality'     => $this->data['district_id'],
                // 'region'       =>'aaaa',
                'country'      => $this->data['division_id'],
                'postalCode'   => $this->data['post_code'],
                'phoneNumber' => $this->data['shipping_phone'],
            ],
            'shippingAddress'   => [
                'firstName'    => $this->data['shipping_name'],
                'email'        => $this->data['shipping_email'],
                'addressLine1' => 'Kai 1',
                'locality'     => $this->data['district_id'],
                // 'region'       => $request->state_id,
                'country'      => $this->data['division_id'],
                'postalCode'   => $this->data['post_code'],
                'phoneNumber' => $this->data['shipping_phone'],
            ],
            'lineItems'         => [],

        ];
        $carts = Cart::content();
        foreach ($carts as $cart) {
            $lineItem = [
                'name'       => $cart->name,
                'quantity'   => intval($cart->qty),
                'finalPrice' => $this->data['GrandTotal'],
            ];
            array_push($payload['lineItems'], $lineItem);
            // dd($payload['lineItems']);
        }
        $payload['payment'] = [
            'method'        => 'paymentInitiation',
            'methodDisplay' => 'Pay with your bank',
            'amount'        => $this->data['GrandTotal'],
            'currency'      => 'EUR', // This must match the currency of the order.
            // 'orderNumber' =>  'RvR-' . substr(md5(rand()), 0, 10),
            // 'invoice_number' => 'RvR' . mt_rand(10000000, 99999999),
            'methodOptions' => [
                'paymentReference'   => $this->data['order_no'],
                'paymentDescription' => $this->data['order_no'],
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
    public function afterPayment(Request $request)
    {

        $order_token = $request->get('order-token');
        JWT::$leeway = 60 * 5;
        $decoded = JWT::decode(
            $request->get('order-token'),
            new Key(config('app.montonio.secret'), 'HS256'),
        );
        $client = new Client();
        try {
            $response = $client->request('GET', 'https://sandbox-stargate.montonio.com/api/orders/' . $decoded->uuid, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $order_token
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);
            // dump($content);
            // dd($decoded);
            // dd($this->data);

            // Process response content
        } catch (RequestException $e) {
            // Handle request exception
        }

        if (
            $decoded->paymentStatus === 'PAID' &&  $decoded->accessKey === config('app.montonio.access')
        ) {

            Session::put('order.payment_type', $content['paymentIntents'][0]['paymentMethodMetadata']['providerName']);
            Session::put('order.payment_method', $content['paymentIntents'][0]['paymentMethodMetadata']['providerName']);
            Session::put('order.transaction_id', $content['uuid']);
            $order_id = newOrder::createOrderRecord();

            $notification = array(
                'message' => 'Your Order Place Successfully',
                'alert-type' => 'success'
            );
            return view('customers.payments.completed_payment')->with($notification);
        } else {
            // dd('b');
        }
    }
}
