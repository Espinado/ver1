<?php

namespace App\Http\Controllers\Customers;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\CheckoutRequest;
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

use GuzzleHttp\Client;
use LaravelLocalization;
use GuzzleHttp\Exception\RequestException;
use App\Helpers\newOrder;
use App\Http\Controllers\Customers\Payments\PayPalController;
use Illuminate\Support\Str;




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
        $data['lineItems'] =[];
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_surname'] = $request->shipping_surname;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->shipping_postcode;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['notes'] = $request->notes;
        $data['payment_method'] = $request->payment_method;
        $data['shipping_method'] = $request->shipping_method;
        $data['order_no']='RvR-' . substr(md5(rand()), 0, 10);
        $data['invoice_no'] = 'RvR' . mt_rand(10000000, 99999999);
        $data['tax_rate']=21;
        $data['delivery_cost'] = $dist_rate->delivery_cost;
        $carts = Cart::content();
        foreach ($carts as $cart) {
            $lineItem = [
                'name'       => $cart->name,
                'quantity'   => intval($cart->qty),
                'amount' => $cart->price,
            ];
            array_push($data['lineItems'], $lineItem);

        }

        if (Session::has('coupon')) {
            $data['SubTotal_with_discount'] = Session::get('coupon')['total_amount'];
            $data['tax_sum']= $data['SubTotal_with_discount']/100*21;
            $data['coupon_name'] = session()->get('coupon')['coupon_name'];
            $data['coupon_discount'] = session()->get('coupon')['coupon_discount'];
            $data['coupon_discount_amount'] = session()->get('coupon')['discount_amount'];
            $data['SubTotal_without_discount'] = Cart::total();
            $data['GrandTotal']= $data['SubTotal_with_discount']+ $data['delivery_cost'];
            $data['GrandTotal_without_tax'] = $data['GrandTotal'] - $data['tax_sum'];
        } else {
            $data['SubTotal_without_discount'] = Cart::total();
            $data['tax_sum'] = $data['SubTotal_without_discount'] / 100 * 21;
            $data['GrandTotal'] = $data['SubTotal_without_discount'] + $data['delivery_cost'];
            $data['GrandTotal_without_tax'] = $data['GrandTotal'] - $data['tax_sum'];
        }
             Session::put('order', $data);







        if ($request->payment_method == 'stripe') {
            return view('customers.payments.stripe.stripe_view', compact('data'));
        } elseif ($request->payment_method == 'cash') {

            return view('customers.payments.cash.cash', compact('data'));
        } else if (
            $request->payment_method == 'bank'
        ) {
             return view('customers.payments.bank.bank', compact('data'));
        } else if (
            $request->payment_method == 'paypal'
        ) {
            return view('customers.payments.paypal.paypal', compact('data'));
        }

    }
}
