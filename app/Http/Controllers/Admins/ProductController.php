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

    public function productView($id) {
        dd($id);
    }
    public function productAdd() {
        return view('admin.products.add_product');

    }
    public function productStore(Request $request ) {

        $image=[];
        if (request()->hasFile('product_images')) {
            foreach ($request->file('product_images') as $key => $originalImage) {
                $name=$originalImage->getClientOriginalName();
                $product_img = Image::make($originalImage);
                $path = public_path() . '/products/';
                $product_img->resize(150, 150);
                $product_img->save($path . $name);
                array_push($image, $name);

            }

            // $originalImage = $request->file('product_images');
            // $brand_logo = Image::make($originalImage);
            // $path = public_path() . '/products/';
            // $brand_logo->resize(150, 150);
            // $brand_logo->save($path . time() . $originalImage->getClientOriginalName());

           }


        $product=new Product();
        $product->product_name            =json_encode($request->product_name);
        $product->product_details         =json_encode($request->product_decription);
        $product->product_code            =$request->product_code;
        $product->product_quantity        =$request->product_quantity;
        $product->selling_price           =$request->product_price;
        $product->brand_id                =71;
        $product->category_id             =$request->product_category;
        $product->images = json_encode($image);
        $product->save();






            // foreach ($images as $key => $file) {
            //     // dd($file);
            //     $image = Image::make($file);
            //     $image->resize(null, 627, function ($constraint) {
            //         $constraint->aspectRatio();
            //     });
            //     $image->save(public_path('/products/' . time() . '.jpg'));
            // }

}



}
