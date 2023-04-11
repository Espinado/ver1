<?php

namespace App\Http\Controllers\Admins;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers\Order;
use App\Models\Customers\OrderItem;
use BenSampo\Enum\Enum;
use PDF;
use Illuminate\Support\Carbon;


class OrderController extends Controller
{
    public function __construct()

    {
        $this->notification = array('message' => 'Status updated', 'alert-type' => 'success');
    }
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
        return view('admin.orders.pending_orders.pending_order_details', compact('order', 'orderItem'));
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
        return view('admin.orders.confirmed_orders.confirmed_order_details', compact('order', 'orderItem'));
    }
    public function processingOrders()
    {

        $orders = Order::where('status', OrderStatus::processing)->get();
        // dd($orders);
        return view('admin.orders.processing_orders.processing_orders', compact('orders'));
    }
    public function processingOrdersDetails($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderItem = OrderItem::where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('admin.orders.processing_orders.processing_order_details', compact('order', 'orderItem'));
    }


    public function confirmOrder($id)
    {
        Order::where('id', $id)->update([
            'status' => OrderStatus::confirmed
        ]);


        return redirect('admin/pending/orders/')->with($this->notification);
    }
    public function toProcessOrder($id)
    {
        Order::where('id', $id)->update([
            'status' => OrderStatus::processing
        ]);
        return redirect('admin/confirmed/orders/')->with($this->notification);
    }
    public function markAsPickeupOrder($id)
    {

        Order::where('id', $id)->update([
            'status' => OrderStatus::picked
        ]);
        return redirect('admin/processing/orders/')->with($this->notification);
    }

    public function orderInvoiceDownload($order_id)
    {
        $order = Order::with('division', 'district', 'state', 'user')
        ->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')
        ->where('order_id', $order_id)
            ->orderBy('id', 'DESC')->get();
        $pdf = Pdf::loadView('customers.invoice.order_invoice', compact('order', 'orderItem'))
        ->setPaper('a4')
            ->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path()
            ]);
        return $pdf->download($order->invoice_no . '-' . Carbon::now()->format('Ymd') . '.pdf');
    }
}
