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
        return view('customers.index', compact('products'));
    }

    public function productDetails($id, $slug)
    {
        $product = Product::findOrFail($id);
        $product_colors=$product->product_color_en;
        $product_size=$product->product_size;
        $product_size=explode(',',$product_size);
        $product_colors=explode(',', $product_colors);
        $related_products=Product::where('category_id', $product->category_id)
        ->where('id', '!=', $id)
        ->orderBy('id', 'DESC')->get();
        $images = ProductImage::where('product_id', $id)->get();
        return view('customers.products.product_details', compact('product', 'images','product_colors', 'product_size', 'related_products'));
    }

    public function productTag($product_tag)
    {
            $products = Product::where('status', true)
            ->where('product_tags', $product_tag)
            ->orderBy('id', 'desc')->get();
        $product_colors = Product::groupBy('product_color_en')
        ->select('product_color_en')
        ->get();


        return view('customers.products.tags_view', compact('products', 'product_tag', 'product_colors'));
    }


    public function SubCategoryProductView($id, $product_subcategory)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();
        $product_colors=Product::where('subcategory_id', $id)->groupBy('product_color_en')
        ->select('product_color_en')
        ->get();
       return view  ('customers.products.category_view', compact('products', 'product_colors'));
    }
    public function SubSubCategoryProductView($id, $product_subcategory)
    {
        $products = Product::where('status', 1)->where('subsubcategory_id', $id)->orderBy('id', 'DESC')->get();
        $product_colors = Product::where('subsubcategory_id', $id)->groupBy('product_color_en')
        ->select('product_color_en')
        ->get();
        return view('customers.products.category_view', compact('products', 'product_colors'));
    }

    /// Product View With Ajax
    public function ProductViewAjax($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);

        $color = $product->product_color_en;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,

        ));
    } // end method
}
