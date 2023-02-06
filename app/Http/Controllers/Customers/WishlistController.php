<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customers\Wishlist;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

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
}
