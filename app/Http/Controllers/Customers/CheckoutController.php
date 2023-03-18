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
                'order_number' => $charge->metadata->order_id,

                'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
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

            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',

            'currency' =>  'EUR',
            'amount' => $total_amount,


            'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => OrderStatus::Pending,
            'created_at' => Carbon::now(),

        ]);

        // Start Send Email
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
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


}
