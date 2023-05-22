<?php

namespace App\Http\Controllers\Customers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\newOrder;
use App\Models\Customers\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CashController extends Controller
{
    public function CashOrder(Request $request)
    {
        $data = json_decode($request->input('data'), true);
        if (Session::has('coupon')) {
            $total_amount = $data['SubTotal_with_discount'];
        } else {
            $total_amount = $data['SubTotal_without_discount'];
        }
       

        $data['transaction_id'] = null;
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

        // End Send Email

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('index')->with($notification);
    } // end method
}
