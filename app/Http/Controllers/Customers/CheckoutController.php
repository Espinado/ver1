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

                return view('customers.cart.checkout', compact('carts', 'cartQty', 'cartTotal', 'divisions'));
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
        // dd($request->all());
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['notes'] = $request->notes;
        $data['cartTotal'] = Cart::total();

        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }




        if ($request->payment_method == 'stripe') {
            return view('customers.payments.stripe.stripe_view', compact('data'));
        } elseif ($request->payment_method == 'cash') {

            return view('customers.payments.cash.cash', compact('data'));
        } else if (
            $request->payment_method == 'bank'
        ) {
            // dd($request->all());
            $carts = Cart::content();
            $payload = [
                'accessKey'         => config('app.montonio.access'),
                'merchantReference' => md5(rand()),
                'returnUrl'         =>  route('product.afterpayment'),
                'notificationUrl'   => route('product.afterpayment.notification'),
                'currency'          => 'EUR',

                'grandTotal'        => $total_amount,

                'locale'            => 'lv',
                'billingAddress'    => [
                    'firstName'    => $request->shipping_name,
                    'email'        => $request->shipping_email,
                    'addressLine1' => 'Kai 1',
                    'locality'     => $request->state_id,
                    'region'       => $request->district_id,
                    'country'      => $request->division_id,
                    'postalCode'   => $request->post_code,
                ],
                'shippingAddress'   => [
                    'firstName'    => $request->shipping_name,

                    'email'        => $request->shipping_email,
                    'addressLine1' => 'Kai 1',
                    'locality'     => $request->state_id,
                    'region'       =>  $request->district_id,
                    'country'      => $request->division_id,
                    'postalCode'   => $request->post_code,
                ],
                'lineItems'         => [],
            ];
            $carts = Cart::content();

            foreach ($carts as $cart) {
                $lineItem = [
                    'name'       => $cart->name,
                    'quantity'   => intval($cart->qty),
                    'finalPrice' => $cart->price,
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
                    'paymentDescription' =>'RvR' . mt_rand(10000000, 99999999),
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
    public function StripeOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        \Stripe\Stripe::setApiKey('sk_test_51MdxE0LYuNRuHnSIhONSDVwEZcL8ufLCYoyx2sX69ZbwNv1q4nPb5K6P0ocnpxlzalUQsx0p9dc0jZrMPa9msHFQ0035WAp0Fv');

        $token = $_POST['stripeToken'];

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $total_amount * 100,
                'currency' => 'eur',
                'description' => 'Example charge',
                'source' => $token,
                'metadata' => ['order_id' => uniqid()],
            ]);

            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_id' => $request->state_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'notes' => $request->notes,

                'payment_type' => 'Stripe',
                'payment_method' => 'Stripe',
                'payment_type' => $charge->payment_method,
                'transaction_id' => $charge->balance_transaction,
                'currency' => $charge->currency,
                'amount' => $total_amount,
                'order_number' => 'RvR-'. substr(md5(rand()), 0, 10),
                'invoice_no' => 'RvR' . mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => OrderStatus::pending,
                'created_at' => Carbon::now(),

            ]);
            $invoice = Order::FindOrFail($order_id);
            $data = [
                'invoice_no' => $invoice->invoice_no,
                'amount'     => $total_amount,
                'name'       => $invoice->name,
                'email'      => $invoice->email,
                'order_number' =>$invoice->order_number,
            ];
            Mail::to($request->email)->send(new OrderMail($data));
            $carts = Cart::content();
            foreach ($carts as $cart) {
                OrderItem::insert([
                    'order_id' => $order_id,
                    'product_id' => $cart->id,
                    'color' => $cart->options->color,
                    'size' => $cart->options->size,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'created_at' => Carbon::now(),

                ]);
            }
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            Cart::destroy();
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



        // dd($charge);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,
            'order_number' =>'RvR-' . substr(md5(rand()), 0, 10),
            'invoice_no' => 'RvR' . mt_rand(10000000, 99999999),
            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',
            'currency' =>  'EUR',
            'amount' => $total_amount,
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => OrderStatus::pending,
            'created_at' => Carbon::now(),

        ]);

        // Start Send Email
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount'     => $total_amount,
            'name'       => $invoice->name,
            'email'      => $invoice->email,
            'order_number' => $invoice->order_number,
        ];

        Mail::to($request->email)->send(new OrderMail($data));

        // End Send Email


        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),

            ]);
        }


        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('index')->with($notification);
    } // end method

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
            $response = $client->request('GET', 'https://sandbox-stargate.montonio.com/api/orders/'.$decoded->uuid, [
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

        dump($order_token);
        dump($content);
        dd($decoded);
        if (
            $decoded->paymentStatus === 'PAID' &&  $decoded->accessKey === config('app.montonio.access')) {
            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_id' => $request->state_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
                'order_number' => 'RvR-' . substr(md5(rand()), 0, 10),
                'invoice_no' => 'RvR' . mt_rand(10000000, 99999999),
                'payment_type' => 'Cash On Delivery',
                'payment_method' => 'Cash On Delivery',
                'currency' =>  'EUR',
                'amount' => $total_amount,
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => OrderStatus::pending,
                'created_at' => Carbon::now(),

            ]);
            return redirect()->route('profile.index');
        } else {
            // dd('b');
        }


}

}
