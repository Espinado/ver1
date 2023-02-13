<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Coupon;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    public function couponView()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function CouponStore(Request $request)
    {
        $request->validate(
            [
                'coupon_name'    => 'required',
                'coupon_validity' => 'required',
                'coupon_discount' => 'required',
            ],
            [
                'coupon_name.required'          => 'Incorrect coupon name',
                'coupon_validity.required'    => 'Incorrect coupon date',
                'coupon_discount.required'    => 'Incorrect discount value',
            ]
        );
        //TODO: validation to request
        //TODo data to json
        $coupon = new Coupon();
        $coupon->coupon_name           = $request->coupon_name;
        $coupon->coupon_validity       = $request->coupon_validity;
        $coupon->coupon_discount       = $request->coupon_discount;
        $coupon->save();
        $notification = array('message' => 'Coupon recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function couponEdit($id)
    {
        $coupons = Coupon::findOrFail($id);
        return view('admin.coupons.edit_coupon', compact('coupons'));
    }


    public function couponUpdate(Request $request, $id)
    {

        Coupon::findOrFail($id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('admin.manage.coupons')->with($notification);
    } // end mehtod

    public function couponDelete($id)
    {

        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
