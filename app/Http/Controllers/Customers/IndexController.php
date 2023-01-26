<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Category;
use LaravelLocalization;
use App\Helpers\CatMultilangArray;
use App\Models\Admins\Product;
use App\Models\Admins\ProductImage;

class IndexController extends Controller
{
    public function index()
    {

        // $categories = Category::with('childrenRecursive')->get();
        // $productIds=$categories->pluck('id')->toArray();
        // $products=Product::whereIn('category_id', $productIds)->get();
        //   return view('customers.index', compact ('categories', 'products'));

        $products = Product::where('status', true)->get();

        $products = Product::where('status', true)->get();
        return view('customers.index', compact('products'));
    }

    public function productDetails($id, $slug)
    {
        $product=Product::findOrFail($id);
        $images=ProductImage::where('product_id',$id)->get();
        return view ('customers.products.product_details', compact('product', 'images'));
    }

    public function productTag($product_tag) {
        $products=Product::where('status', true)
                         ->where('product_tags', $product_tag)
                         ->orderBy('id', 'desc')->get();
                        
      return view('customers.products.tags_view', compact('products', 'product_tag'));
    }
}
