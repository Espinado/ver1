<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customers\Wishlist;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Admins\Product;
use LaravelLocalization;
class WishlistController extends Controller
{

    public function addToWishlist(Request $request, $product_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();
            if ($exists) {
                return response()->json(['error' => __('system.already_in_wishlist', [], app()->getLocale())], 320);
            } else {
                Wishlist::insert([
                    'user_id'    => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => __('system.added_to_wishlist', [], app()->getLocale())], 200);
            }
        } else {
            // dump( LaravelLocalization::getCurrentLocaleNative());
            // dd(__('system.not_authorized'));
            return response()->json(['error' => __('system.not_authorized', [], app()->getLocale())], 320);
        }
    }

    public function ReadWishlist()
    {

        return view ('customers.products.view_wishlist');
    }
    public function GetWishlistProduct()

    {

        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        // dd($wishlist);
       return response()->json($wishlist);
    } // end mehtod

    public function RemoveWishlistProduct($id)
    {

        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => __('system.removed_from_wishlist', [], app()->getLocale())]);
    }

}
