<?php

namespace App\Helpers;

use App\Models\Customers\Order;
use App\Models\Customers\OrderItem;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Enums\OrderStatus;
use Gloudemans\Shoppingcart\Facades\Cart;


class newOrder
{


    public static function createOrderRecord($data, $total_amount)
    {

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $data['division_id'],
            'district_id' => $data['district_id'],
            'state_id' => $data['state_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'post_code' => $data['post_code'],
            'notes' => $data['notes'],
            'order_number' => 'RvR-' . substr(md5(rand()), 0, 10),
            'invoice_no' => 'RvR' . mt_rand(10000000, 99999999),
            'payment_type' => $data['payment_type'],
            'payment_method' => $data['payment_method'],
            'transaction_id' => $data['transaction_id'],
            'currency' =>  'EUR',
            'amount' => $total_amount,
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => OrderStatus::pending,
            'created_at' => Carbon::now(),

        ]);
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
       return $order_id;
    }
}
