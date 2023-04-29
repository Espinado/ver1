<?php

namespace App\Http\Controllers\Customers;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\CheckoutRequest;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Admins\ShipDivision;
use App\Models\Admins\ShipDistrict;
use App\Models\Admins\ShipState;
use App\Models\Customers\Order;
use App\Models\Customers\OrderItem;
use StripeOrder\Stripe;
use FFI\Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use GuzzleHttp\Client;
use LaravelLocalization;
use GuzzleHttp\Exception\RequestException;
use App\Helpers\newOrder;
use App\Notifications\OrderCreated;
use App\Http\Controllers\Customers\Payments\PayPayController;

class CheckoutController extends Controller
{


    public function index()
    {
        if (Auth::check()) {
            if (Cart::total() > 0) {

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
                $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
                return view('customers.cart.checkout', compact('carts', 'cartQty', 'cartTotal', 'divisions','districts'));
            } else {

                $notification = array(
                    'message' => __('system.shop_one_product', [], app()->getLocale()),
                    'alert-type' => 'error'
                );
                return redirect()->to('/')->with($notification);
            }
        } else {

            $notification = array(
                'message' => __('system.please_login', [], app()->getLocale()),
                'alert-type' => 'error'
            );
            return redirect()->route('login')->with($notification);
        }
    }
    public function AjaxGetDistricts($division_id)
    {
        $district = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($district);
    }

    public function AjaxGetStates($district_id)
    {
        $states = ShipState::where('district_id', $district_id)->orderBy('state_name', 'ASC')->get();
        return json_encode($states);
    }
    public function checkoutStore(CheckoutRequest $request)
    {

        $dist_rate = ShipDistrict::where('id', $request->district_id)->first();
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['notes'] = $request->notes;
        $data['delivery_cost']=$dist_rate->delivery_cost;
        $data['cartTotal'] = Cart::total() + $data['delivery_cost'];


        if ($request->payment_method == 'stripe') {
            return view('customers.payments.stripe.stripe_view', compact('data'));
        } elseif ($request->payment_method == 'cash') {

            return view('customers.payments.cash.cash', compact('data'));
        } else if (
            $request->payment_method == 'bank'
        ) {
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'] + $data['delivery_cost'];
            } else {
                $total_amount = round(Cart::total() + $data['delivery_cost']);
            }

            $payload = [
                'accessKey'         => config('app.montonio.access'),
                'merchantReference' => md5(rand()),
                'returnUrl'         =>  route('product.afterpayment'),
                'notificationUrl'   => route('product.afterpayment.notification'),
                'currency'          => 'EUR',

                'grandTotal'        => $total_amount + $data['delivery_cost'],

                'locale'            => 'lv',
                'billingAddress'    => [
                    'firstName'    => $request->shipping_name,
                    'email'        => $request->shipping_email,
                    'addressLine1' => 'Kai 1',
                    'locality'     => $request->district_id,
                    // 'region'       =>'aaaa',
                    'country'      => $request->division_id,
                    'postalCode'   => $request->post_code,
                    'phoneNumber' => $request->shipping_phone,

                ],
                'shippingAddress'   => [
                    'firstName'    => $request->shipping_name,
                    'email'        => $request->shipping_email,
                    'addressLine1' => 'Kai 1',
                    'locality'     => $request->district_id,
                    // 'region'       => $request->state_id,
                    'country'      => $request->division_id,
                    'postalCode'   => $request->post_code,
                    'phoneNumber' => $request->shipping_phone,
                ],
                'lineItems'         => [],
            ];
            $carts = Cart::content();
            foreach ($carts as $cart) {
                $lineItem = [
                    'name'       => $cart->name,
                    'quantity'   => intval($cart->qty),
                    'finalPrice' => $cart->price+ $data['delivery_cost'],
                ];
                array_push($payload['lineItems'], $lineItem);
                // dd($payload['lineItems']);
            }
            $payload['payment'] = [
                'method'        => 'paymentInitiation',
                'methodDisplay' => 'Pay with your bank',
                'amount'        => $total_amount,
                'currency'      => 'EUR', // This must match the currency of the order.
                // 'orderNumber' =>  'RvR-' . substr(md5(rand()), 0, 10),
                // 'invoice_number' => 'RvR' . mt_rand(10000000, 99999999),
                'methodOptions' => [
                    'paymentReference'   => 'RvR-' . substr(md5(rand()), 0, 10),
                    'paymentDescription' => 'RvR' . mt_rand(10000000, 99999999),
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
        } else if ($request->payment_method == 'paypal') {
            $payPayController = new PayPayController();
            $payPayController->init($data);
        }
    }
    public function StripeOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }
        \Stripe\Stripe::setApiKey(config('payments.stripe.' . env('APP_ENV')));
        $token = $_POST['stripeToken'];
        try {
            $charge = \Stripe\Charge::create([
                'amount' => $total_amount * 100,
                'currency' => 'eur',
                'description' => 'Example charge',
                'source' => $token,
                'metadata' => ['order_id' => uniqid()],
            ]);
            // dd($charge);
            $data = $request->all();
            $data['transaction_id'] = $charge->balance_transaction;
            $order_id = newOrder::createOrderRecord($data, $total_amount);

            $invoice = Order::FindOrFail($order_id);
            $data = [
                'invoice_no' => $invoice->invoice_no,
                'amount'     => $total_amount,
                'name'       => $invoice->name,
                'email'      => $invoice->email,
                'order_number' => $invoice->order_number,
            ];
            Auth::user()->notify(new OrderCreated($data));

            $notification = array(
                'message' => __('system.placed_order', [], app()->getLocale()),
                'alert-type' => 'success'
            );

            return redirect()->route('index')->with($notification);
        } catch (\Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught

            $notification = array('message' => $e->getMessage(), 'alert-type' => 'error');
            return redirect('/checkout')->with($notification);
        } catch (\Stripe\Exception\RateLimitException $e) {
            $notification = array('message' => $e->getMessage(), 'alert-type' => 'error');
            return redirect('/checkout')->with($notification);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $notification = array('message' => $e->getMessage(), 'alert-type' => 'error');
            return redirect('/checkout')->with($notification);
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $notification = array('message' => $e->getMessage(), 'alert-type' => 'error');
            return redirect('/checkout')->with($notification);
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $notification = array('message' => $e->getMessage(), 'alert-type' => 'error');
            return redirect('/checkout')->with($notification);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $notification = array('message' => $e->getMessage(), 'alert-type' => 'error');
            return redirect('/checkout')->with($notification);
        } catch (Exception $e) {
            $notification = array('message' => $e->getMessage(), 'alert-type' => 'error');
            return redirect('/checkout')->with($notification);
        }
    }
    public function CashOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }
        $data = $request->all();
        $data['state_id']=$request->state_id ? $request->state_id : null;
        $data['transaction_id']=null;
        $order_id = newOrder::createOrderRecord($data, $total_amount);

        // Start Send Email
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount'     => $total_amount,
            'name'       => $invoice->name,
            'email'      => $invoice->email,
            'order_number' => $invoice->order_number,
        ];
        Auth::user()->notify(new OrderCreated($data));
        // End Send Email

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('index')->with($notification);
    } // end method

    public function afterPayment(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }
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

            // Process response content
        } catch (RequestException $e) {
            // Handle request exception
        }

        if (
            $decoded->paymentStatus === 'PAID' &&  $decoded->accessKey === config('app.montonio.access')
        ) {
            $data=[];
            $data['user_id']= Auth::id();
            $data['division_id']= $content['shippingAddress']['country'];
            $data['district_id'] = $content['shippingAddress']['locality'];
            $data['state_id']=NULL;
            $data['notes'] = NULL;
            $data['name']= $content['shippingAddress']['firstName'];
            $data['email'] = $content['shippingAddress']['email'];
            $data['phone'] = $content['shippingAddress']['phoneNumber'];
            $data['post_code']= $content['shippingAddress']['postalCode'];
            $data['order_number']= $content['paymentIntents'][0]['paymentMethodMetadata']['paymentReference'];
            $data['invoice_no'] = $content['paymentIntents'][0]['paymentMethodMetadata']['paymentDescription'];
            $data['payment_type'] = $content['paymentIntents'][0]['paymentMethodMetadata']['providerName'];
            $data['payment_method'] = $content['paymentIntents'][0]['paymentMethodMetadata']['providerName'];
            $data['amount']= $content['grandTotal'];
            $data['transaction_id'] = $content['uuid'];

            $order_id = newOrder::createOrderRecord($data, $total_amount);

            $invoice = Order::FindOrFail($order_id);
            $data = [
                'invoice_no' => $invoice->invoice_no,
                'amount'     => $total_amount,
                'name'       => $invoice->name,
                'email'      => $invoice->email,
                'order_number' => $invoice->order_number,
            ];
            Auth::user()->notify(new OrderCreated($data));


            $basic  = new \Vonage\Client\Credentials\Basic("e2150a5a", "MWcfcGSwbinezJ8a");
            $client = new \Vonage\Client($basic);
            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS('+37125554950', 'Arguss shop', 'Order Nr.' . $content['paymentIntents'][0]['paymentMethodMetadata']['paymentReference'] . ',Invoice nr.' . $content['paymentIntents'][0]['paymentMethodMetadata']['paymentDescription'])
            );

            $notification = array(
                'message' => 'Your Order Place Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('profile.index')->with($notification);
        } else {
            // dd('b');
        }
    }
    public function GetDistrictDeliveryRates($district_id)
    {
        $dist_rate=ShipDistrict::where('id', $district_id)->first();

         return response()->json([
            'rate'=>$dist_rate
         ]);
    }
}
