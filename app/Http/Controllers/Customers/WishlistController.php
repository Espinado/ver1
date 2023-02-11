<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customers\Wishlist;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Admins\Product;

class WishlistController extends Controller
{

    public function addToWishlist(Request $request, $product_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();
            if ($exists) {
                return response()->json(['error' => 'Already in wishlist'], 320);
            } else {
                Wishlist::insert([
                    'user_id'    => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Added to wishlist'], 200);
            }
        } else {
            return response()->json(['error' => 'Not authorised'], 320);
        }
    }

    public function ReadWishlist()
    {

        return view ('customers.products.view_wishlist');
    }
    public function GetWishlistProduct()

    {

        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
       return response()->json($wishlist);
    } // end mehtod

    public function RemoveWishlistProduct($id)
    {
     
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Successfully Product Remove']);
    }

}
