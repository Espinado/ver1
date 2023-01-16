<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Slider;
use Image;
use App\Models\Admins\ProductImage;

class SliderController extends Controller
{
   public function sliderView(){

    $sliders=Slider::latest()->get();
    return view('admin.sliders.index', compact('sliders'));
   }
}
