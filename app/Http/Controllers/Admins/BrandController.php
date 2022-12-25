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
        return view('admin.brands.index', compact ('brands'));
    }

    public function store(StoreBrandRequest $request) {
        $validated = $request->validated();
        if ($validated->fails()) {
           dd($validated->errors());
        } else{
        dd($request->all());
        $validator = $request->validated();
        dd($validator);

        $originalImage= $request->file('brand_logo');
        $brand_logo = Image::make($originalImage);
        $path = public_path() . '/brands/';
        $brand_logo->resize(150, 150);
        $brand_logo->save($path . time() . $originalImage->getClientOriginalName());
        $brand= new Brand();
        $brand->brand_logo = time() . $originalImage->getClientOriginalName();
        $brand->brand_name = $request->brand_name;
        $brand->save();
        return back()->with('success', 'Recorded');
        }

    }
}
