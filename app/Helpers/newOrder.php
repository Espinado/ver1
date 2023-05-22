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


    public static function createOrderRecord($data)
    {
// dd($data);
         $order=new Order();

            $order->user_id               = Auth::id();
            $order->division_id           = $data['division_id'];
            $order->district_id           =$data['district_id'];
            $order->state_id              = $data['state_id'];
            $order->name                 = $data['shipping_name'];
            $order->email                = $data['shipping_email'];
            $order->phone                = $data['shipping_phone'];
            $order->post_code             = $data['post_code'];
            $order->notes                 = $data['notes'];
            $order->order_number            = $data['order_no'];
            $order->invoice_no              = $data['invoice_no'];
            $order->payment_type             = $data['payment_type'];
            $order->payment_method             = $data['payment_method'];
            $order->transaction_id  =          $data['transaction_id'];
            $order->shipping_method =         $data['shipping_method'];
            $order->delivery_cost =         $data['delivery_cost'];
            $order->amount_without_tax=      $data['GrandTotal_without_tax'];
            $order->currency                 =  'EUR';
            $order->tax_sum=                   $data['tax_sum'];
            $order->amount                   = $data['GrandTotal'];
            $order->order_date                   =   Carbon::now()->format('d F Y');
            $order->order_month                  =  Carbon::now()->format('F');
            $order->order_year                  = Carbon::now()->format('Y');
            $order->status                      = OrderStatus::pending;
            $order->created_at                  = Carbon::now();
            $order->save();
        $order_id = $order->id;



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
