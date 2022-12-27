<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Product;
 use Cart;

class CartController extends Controller
{
   public function add_wishlist ($id) {
    // dd(session()->all('cart'));
    // session()->forget('cart');
        $product = Product::findOrFail($id);
dump($product);
        $cart = session()->get('cart', []);

        if(isset($cart[3])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => 'test',
                "quantity" => 1,
                "price" => $product->selling_price,

            ];
        }

        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

}
