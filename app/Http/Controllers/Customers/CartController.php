<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Carbon;
use App\Models\Admins\Coupon;
use Illuminate\Support\Facades\Session;
use Auth;

class CartController extends Controller
{

    public function AddToCart(Request $request, $id)
    {

        // if (Session::has('coupon')) {
        //     Session::forget('coupon');
        // }
        $product = Product::findOrFail($id);
        if ($product->product_qty < $request->quantity) {
            return response()->json(['error' => 'Not available']);
        } else {
            if ($product->discount_price == NULL) {
                Cart::add([
                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $product->selling_price,
                    'weight' => 1,
                    'options' => [
                        'image' => $product->product_thambnail,
                        'color' => $request->color,
                        'size' => $request->size,
                    ],
                ]);
                return response()->json(['success' => 'Successfully Added on Your Cart']);
            } else {

                Cart::add([
                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $product->discount_price,
                    'weight' => 1,
                    'options' => [
                        'image' => $product->product_thambnail,
                        'color' => $request->color,
                        'size' => $request->size,
                    ],
                ]);
                return response()->json(['success' => 'Successfully Added on Your Cart']);
            }
        }
    }
    public function ReadCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),

        ));
    }

    public function CartRemoveItem($rowId)
    {

        Cart::remove($rowId);
        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);
        }
        return response()->json(['success' => 'Product Remove from Cart']);
    }

    public function MyCart()
    {

        return view('customers.cart.view_mycart');
    }

    public function GetCartProduct()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),

        ));
    } //end method

    public function CartIncrement($rowId)
    {
        // dump($rowId, $id);
        $row = Cart::get($rowId);
        // $product = Product::findOrFail($id);
        Cart::update($rowId, $row->qty + 1);
        // if ($product->product_qty < $request->quantity) {
        //     return response()->json(['error' => 'Not available']);
        // } else {
            if (Session::has('coupon')) {

                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name', $coupon_name)->first();

                Session::put('coupon', [
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                    'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
                ]);
            }

            return response()->json('increment');
        // }
    }
    public function CartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);
        }

        return response()->json('decrement');
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);

            return response()->json(array(

                'success' => 'Coupon Applied Successfully',
                'validity' => true,
            ));
        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function calculateCoupon()
    {

        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }
    public function removeCoupon()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }

   
}
