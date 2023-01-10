<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Product;
use Intervention\Image\Facades\Image;
use App\Models\Admins\Category;
use App\Models\Admins\SubCategory;
use App\Models\Admins\SubSubCategory;
use App\Models\Admins\Brand;

class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware('admin');
    }

    public function index()
    {

        $products = Product::all();
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




        dd($request->all());
        if (request()->hasFile('product_trumbnail')) {
            $image = $request->file('product_thambnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(917, 1000)->save(public_path().'/products/thambnails/' . $name_gen);
            $save_url = 'upload/products/thambnail/' . $name_gen;
        }

        $image = [];
        if (request()->hasFile('product_images')) {
            foreach ($request->file('product_images') as $key => $originalImage) {
                $name = $originalImage->getClientOriginalName();
                $product_img = Image::make($originalImage);
                $path = public_path() . '/products/';
                $product_img->resize(150, 150);
                $product_img->save($path . $name);
                array_push($image, $name);
            }
        }

        $product = new Product();
        $product->product_name            = json_encode($request->product_name);
        $product->product_details         = json_encode($request->product_decription);
        $product->product_code            = $request->product_code;
        $product->product_quantity        = $request->product_quantity;
        $product->selling_price           = $request->product_price;
        $product->brand_id                = 71;
        $product->category_id             = $request->product_category;
        $product->images = json_encode($image);
        $product->trumbnail = $trumbName;
        $product->save();


    }
}
