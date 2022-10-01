<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Models\Admins\Brand;
use App\Interfaces\BrandRepositoryInterface;

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

    public function store(Request $request) {

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
