<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Category;
use LaravelLocalization;
use App\Helpers\CatMultilangArray;
use App\Models\Admins\Product;
use App\Models\Admins\ProductImage;
use WebToPay;
use App\Models\Admins\FAQ;




class IndexController extends Controller
{
    public function index()
    {
        // dump( LaravelLocalization::getCurrentLocaleNative());
// WebToPay::getPaymentMethodList('EUR', '1');
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
        // dd($product_tag);
            $products = Product::where('status', true)
            ->whereJsonContains('product_tags->'.app()->getlocale(), $product_tag)
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
        // dd($id);
        $product1 = Product::with('category', 'brand')->findOrFail($id);
        $productData = $product1->getTranslation('product_name', app()->getLocale());

        $productColor = $product1->getTranslation('product_color_en', app()->getLocale());
        $productColor = explode(',', $productColor);

        $product = [
            'product_name' => $productData,
            'id' => $product1->id,
            'category_name' => $product1->category->category_name,
            'product_thambnail'=>$product1->product_thambnail,
            'selling_price' => $product1->selling_price,
            'discount_price' => $product1->discount_price,
            'product_qty' => $product1->product_qty,
            'brand_name' => $product1->brand->brand_name,
            'product_thumbnail' => $product1->product_thumbnail,
            'product_code' => $product1->product_code,
        ];

        $size = $product1->product_size;
        $productSize = explode(',', $size);

        return response()->json([
            'product' => $product,
            'color' => $productColor,
            'size' => $productSize,
        ]);
    } // end method

    public function faq() {
        $faqs=Faq::all();
        $latest_faq = FAQ::latest()->first();
        $last_created_date = $latest_faq->created_at->format('d-m-Y');
        // dd($last_created_date);
        return view ('customers.faq.faqView', compact('faqs', 'last_created_date'));

    }
    public function terms() {
        return view ('customers.terms.termsView');
    }


}
