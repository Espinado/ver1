<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Product;
use Intervention\Image\Facades\Image;

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

    public function productView($id)
    {
        dd($id);
    }
    public function productAdd()
    {
        return view('admin.products.add_product');
    }
    public function productStore(Request $request)
    {
        // dd($request->all());
        if (request()->hasFile('product_trumbnail')) {
            $originalImage = $request->file('product_trumbnail');
            $trumbName=$originalImage->getClientOriginalName();
            $trumbnail = Image::make($originalImage);
            $path = public_path() . '/products/trumbnails/';
            $trumbnail->resize(150, 150);
            $trumbnail->save($path .$trumbName);
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
// dd($trumbName);

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
