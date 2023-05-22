<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Admins\Product;
use Image;
use App\Models\Admins\Category;
use App\Models\Admins\SubCategory;
use App\Models\Admins\SubSubCategory;
use App\Models\Admins\Brand;
use App\Models\Admins\ProductImage;
use Carbon\Carbon;
use App\Models\Admins\MultiImg;
use LaravelLocalization;
use App\Http\Requests\Admin\MultiImageRequest;


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
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.products.add_product', compact('categories', 'brands'));
    }
    public function productStore(ProductRequest $request)
    {
    // dd($request->all());
        $validatedData = $request->validated();
        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('products/trumbnails/' . $name_gen);
        $save_url = 'products/trumbnails/' . $name_gen;

        $product = new Product();
        $product->product_name            = $validatedData['product_name'];
        $product->brand_id                = $validatedData['brand_id'];
        $product->category_id             = $validatedData['category_id'];
        $product->subcategory_id          = $request->subcategory_id;
        $product->subsubcategory_id       = $request->subsubcategory_id;
        $product->product_code            = $validatedData['product_code'];
        $product->product_qty             = $validatedData['product_qty'];
        $product->slug                   = 'item';
        $product->product_color_en        = $validatedData['product_color'];
        $product->short_description       = $validatedData['short_descp'];
        $product->product_tags            = $validatedData['product_tags'];
        $product->product_size            = $request->product_size;
        $product->long_description        = $validatedData['long_descp'];
        $product->selling_price           = $validatedData['selling_price'];
        $product->discount_price          = $request->discount_price;
        $product->featured                = $request->featured;
        $product->hot_deals               = $request->hot_deals;
        $product->special_offer           = $request->special_offer;
        $product->special_deals           = $request->special_deals;
        $product->product_thambnail       = $save_url;
        $product->status                  = true;
        $product->save();
        // $validatedImages = $imageRequest->validated();

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

    public  function productEdit($id)
    {

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);
        $multiImgs = ProductImage::where('product_id', $id)->get();

        return view('admin.products.edit_product', compact('categories', 'brands', 'subcategory', 'subsubcategory', 'products', 'multiImgs'));
    }
    public function productUpdate(ProductRequest $request)
    {

        $validatedData = $request->validated();
        Product::where('id', $request->id)->update([
            'product_name'          => $validatedData['product_name'],
            'brand_id'              => $validatedData['brand_id'],
            'category_id'           => $validatedData['category_id'],
            'subcategory_id'        => $request->subcategory_id,
            'subsubcategory_id'     => $request->subsubcategory_id,
            'product_code'          => $validatedData['product_code'],
            'product_qty'           => $validatedData['product_qty'],
            'product_color_en'      => $validatedData['product_color'],
            'short_description'     => $validatedData['short_descp'],
            'product_tags'          => $validatedData['product_tags'],
            'product_size'          => $request->product_size,
            'long_description'      => $validatedData['long_descp'],
            'selling_price'         => $validatedData['selling_price'],
            'discount_price'        => $request->discount_price,
            'featured'              => $request->featured,
            'hot_deals'             => $request->hot_deals,
            'special_offer'         => $request->special_offer,
            'special_deals'         => $request->special_deals,
        ]);
        if ($request->File('product_thambnail')) {
            $trumbnail = $request->product_thambnail;
            $name_gen = hexdec(uniqid()) . '.' . $trumbnail->getClientOriginalExtension();

            Image::make($trumbnail)->resize(917, 1000)->save('products/trumbnails/' . $name_gen);
            $save_url = 'products/trumbnails/' . $name_gen;
            $prodTrumb = Product::where('id', $request->id)->first();
           

            unlink($prodTrumb->product_thambnail);
            Product::where('id', $request->id)->update([
                'product_thambnail'     => $save_url,
            ]);
        }
        $notification = array('message' => 'Product updated', 'alert-type' => 'success');
        return redirect('admin/manage/product/')->with($notification);
    }
    public function MultiImageUpdate(Request $request)
    {


        $imgs = $request->multi_img;
        foreach ($imgs as $id => $img) {
            $imgDel = ProductImage::FindOrFail($id);
            // unlink($imgDel->photo_name);
            $make_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('products/images/' . $make_gen);
            $upload_url = 'products/images/' . $make_gen;
            ProductImage::where('id', $id)->update([
                'photo_name' => $upload_url,
                'updated_at' => Carbon::now()
            ]);
        }
        $notification = array('message' => 'Image changed', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function MultiImageDelete($id)
    {
        $oldImg = ProductImage::FindOrFail($id);
        // unlink($oldImg->photo_name);
        ProductImage::findOrFail($id)->delete();
        $notification = array('message' => 'Deleted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function ProductActive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();

        $images = ProductImage::where('product_id', $id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            ProductImage::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method
}
