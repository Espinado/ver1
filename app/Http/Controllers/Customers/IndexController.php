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
        $product = Product::findOrFail($id);
        $images = ProductImage::where('product_id', $id)->get();
        return view('customers.products.product_details', compact('product', 'images'));
    }

    public function productTag($product_tag)
    {
            $products = Product::where('status', true)
            ->where('product_tags', $product_tag)
            ->orderBy('id', 'desc')->get();

        return view('customers.products.tags_view', compact('products', 'product_tag'));
    }

    public function productCategory($id, $product_category)
    {

        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->get();
        dd($products);
        // $categories = Category::orderBy('category_name_en', 'ASC')->get();

    }
    public function SubCategoryProductView($id, $product_subcategory)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();
       return view  ('customers.products.category_view', compact('products'));
    }
    public function SubSubCategoryProductView($id, $product_subcategory)
    {
        $products = Product::where('status', 1)->where('subsubcategory_id', $id)->orderBy('id', 'DESC')->get();
        return view('customers.products.category_view', compact('products'));
    }
}
