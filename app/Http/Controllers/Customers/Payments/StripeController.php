<?php

namespace App\Http\Controllers\Customers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Customers\Order;
use App\Models\Customers\OrderItem;
use App\Helpers\newOrder;
use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Exception\RequestException;
use FFI\Exception;
use Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use GuzzleHttp\Client;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripeController extends Controller
{
    public function StripeOrder(Request $request)
    {
        $data = json_decode($request->input('data'), true);
        // dd($data);
        // dd($request->all());
        if (Session::has('coupon')) {
            $total_amount = $data['SubTotal_with_discount'];
        } else {
            $total_amount = $data['SubTotal_without_discount'];
        }

        \Stripe\Stripe::setApiKey(config('payments.stripe.' . env('APP_ENV')));
        $token = $_POST['stripeToken'];
        try {
            $lineItems = [];
            foreach ($data['lineItems'] as $item) {
                $lineItems[] = [
                    'name' => $item['name'],
                    'amount' => $item['amount'] * 100, // Convert to cents
                    'currency' => 'eur',
                    'quantity' => $item['quantity'],
                ];
            }

            $charge = Charge::create([
                'amount' => $data['GrandTotal'] * 100, // Convert to cents
                'currency' => 'eur',
                'source' => $token,
                'metadata' => ['order_id' => $data['order_no']],
                'shipping' => [
                    'name' => $data['shipping_name'] . ' ' . $data['shipping_surname'],
                    'address' => [
                        'line1' => $data['post_code'],
                        'city' => $data['district_id'],
                        'state' => $data['state_id'],
                        'country' => 'LV',
                    ],
                    'phone' => $data['shipping_phone'],
                    // 'email' => $data['shipping_email'],
                ],
                'metadata' => [
                    'notes' => $data['notes'],
                    'payment_method' => $data['payment_method'],
                    'delivery_cost' => $data['delivery_cost'],
                    'subtotal_without_discount' => $data['SubTotal_without_discount'],
                    'tax_sum' => $data['tax_sum'],
                    'grand_total' => $data['GrandTotal'],
                ]
            ]);

            // Handle the charge response as needed
            // dd($charge->balance_transaction);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle any errors that occur during the charge creation
            $notification = array('message' => $e->getMessage(), 'alert-type' => 'error');
            return redirect('/checkout')->with($notification);
        }

        Session::put('order.payment_type', 'Card');
        Session::put('order.payment_method', 'Card');
        Session::put('order.transaction_id', $charge->balance_transaction);
            $order_id = newOrder::createOrderRecord();




            $notification = array(
                'message' => __('system.placed_order', [], app()->getLocale()),
                'alert-type' => 'success'
            );

            return redirect()->route('index')->with($notification);

    }

}
