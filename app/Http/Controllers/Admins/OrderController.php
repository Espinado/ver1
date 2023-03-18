<?php

namespace App\Http\Controllers\Admins;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers\Order;
use App\Models\Customers\OrderItem;
use BenSampo\Enum\Enum;

class OrderController extends Controller
{
    public function pendingOrders()
    {

        $orders = Order::where('status', OrderStatus::pending)->get();
        // dd($orders);
        return view('admin.orders.pending_orders.pending_orders', compact('orders'));
    }
    public function pendingOrdersDetails($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderItem = OrderItem::where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('admin.orders.pending_orders.pending_order_details', compact('order','orderItem'));
    }

    public function confirmedOrders()
    {

        $orders = Order::where('status', OrderStatus::confirmed)->get();
        // dd($orders);
        return view('admin.orders.confirmed_orders.confirmed_orders', compact('orders'));
    }
    public function confirmedOrdersDetails($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderItem = OrderItem::where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('admin.orders.confirmed_order_details', compact('order', 'orderItem'));
    }
}
