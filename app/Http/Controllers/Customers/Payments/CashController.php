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

        Session::put('order.payment_type', 'Cash on delivery');
        Session::put('order.payment_method', 'Cash on delivery');
        Session::put('order.transaction_id', null);
        $order_id = newOrder::createOrderRecord();
        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );

        return view('customers.payments.completed_payment')->with($notification);
    } // end method
}
