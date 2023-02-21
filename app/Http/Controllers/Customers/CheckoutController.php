<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Admins\ShipDivision;
use App\Models\Admins\ShipDistrict;
use App\Models\Admins\ShipState;

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
                $states = ShipState::orderBy('state_name', 'ASC')->get();

                return view('customers.cart.checkout', compact('carts', 'cartQty', 'cartTotal', 'divisions', 'districts', 'states'));
            } else {

                $notification = array(
                    'message' => 'Shopping At list One Product',
                    'alert-type' => 'error'
                );

                return redirect()->to('/')->with($notification);
            }
        } else {

            $notification = array(
                'message' => 'You Need to Login First',
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
}
