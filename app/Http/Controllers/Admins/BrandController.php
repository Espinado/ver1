<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Models\Admins\Brand;
use App\Interfaces\BrandRepositoryInterface;
use App\Http\Requests\StoreBrandRequest;

class BrandController extends Controller
{

    private BrandRepositoryInterface $BrandRepository;
    public function __construct(BrandRepositoryInterface $BrandRepository)
    {
        $this->BrandRepository = $BrandRepository;
        $this->middleware('admin');
    }

    public function index()
    {
        $brands = $this->BrandRepository->getAllBrands();
        return view('admin.brands.index', compact('brands'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'brand_name' => 'required|min:4',
            'brand_logo' => 'required',

        ], [
            'brand_name.required' => 'Invalid input'
        ]);
        $image = $request->file('brand_logo');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('brands/' . $name_gen);
        $save_url = 'brands/' . $name_gen;
        $brand = new Brand();
        $brand->brand_logo = $save_url;
        $brand->brand_name = $request->brand_name;
        $brand->save();
        $notification = array('message' => 'Brand recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }
    public function delete($id)
    {
        $brand=Brand::findOrFail($id);
        unlink($brand->brand_logo);
        $brand->delete();
        $notification = array('message' => 'Brand deleted', 'alert-type' => 'success');
        return redirect()->route('admin.brands')->with($notification);

    }
    public function update(Request $request, $id)
    {
        $brand_id = $request->id;
        $old_img = $request->old_image;
        if ($request->file('brand_logo')) {
            $image = $request->file('brand_logo');
            unlink($old_img);
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('brands/' . $name_gen);
            $save_url = 'brands/' . $name_gen;
            Brand::findOrFail($brand_id)->update([
                'brand_logo' => $save_url,
                'brand_name' => $request->brand_name
            ]);
            $notification = array('message' => 'Brand updated', 'alert-type' => 'info');
            return redirect()->route('admin.brands')->with($notification);
        } else {
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name
            ]);
            $notification = array('message' => 'Brand updated', 'alert-type' => 'info');
            return redirect()->route('admin.brands')->with($notification);

        }
    }
}
