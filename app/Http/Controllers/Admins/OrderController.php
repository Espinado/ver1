<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers\Order;
use App\Models\Customers\OrderItem;

class OrderController extends Controller
{
    public function pendingOrders()
    {

        $orders = Order::where('status', 'pending')->get();
        // dd($orders);
        return view('admin.orders.pending_orders', compact('orders'));
    }
    public function pendingOrdersDetails($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderItem = OrderItem::where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('admin.orders.order_details', compact('order','orderItem'));
    }
}
