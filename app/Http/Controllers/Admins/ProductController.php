<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Product;
use Image;
use App\Models\Admins\Category;
use App\Models\Admins\SubCategory;
use App\Models\Admins\SubSubCategory;
use App\Models\Admins\Brand;
use App\Models\Admins\ProductImage;
use Carbon\Carbon;


class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware('admin');
    }

    public function index()
    {

        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }


    public function productAdd()
    {
        $categories=Category::latest()->get();
        $brands=Brand::latest()->get();
        return view('admin.products.add_product', compact('categories', 'brands'));
    }
    public function productStore(Request $request)
    {

//TODO ProductRequest


            $image = $request->file('product_thambnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(917, 1000)->save('products/trumbnails/'.$name_gen);
            $save_url ='products/trumbnails/'. $name_gen;


        $product = new Product();
        $product->product_name            = $request->product_name;
        $product->brand_id                = $request->brand_id;
        $product->category_id             = $request->category_id;
        $product->subcategory_id          = $request->subcategory_id;
        $product->subsubcategory_id       = $request->subsubcategory_id;
        $product->product_code            = $request->product_code;
        $product->product_qty             = $request->product_qty;
        $product->product_color_en           = $request->product_color;
        $product->short_description       = $request->short_descp;
        $product->product_tags            = $request->product_tags;
        $product->product_size            = $request->product_size;
        $product->long_description        = $request->long_descp;
        $product->selling_price           = $request->selling_price;
        $product->discount_price          = $request->discount_price;
        $product->featured                = $request->featured;
        $product->hot_deals               = $request->hot_deals;
        $product->special_offer           = $request->special_offer;
        $product->special_deals           = $request->special_deals;
        $product->product_thambnail       = $save_url;
        $product->status                  = true;
        $product->save();
        // dd($product);

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('products/images/' . $make_gen);
            $upload_url = 'products/images/' . $make_gen;
            ProductImage::insert([
                'product_id'   =>  $product->id,
                'photo_name'   =>  $upload_url,
                'created_at'   =>  Carbon::now(),

            ]);
        }
        $notification = array('message' => 'Product added', 'alert-type' => 'success');
        return redirect('admin/add/product')->with($notification);
    }
}
