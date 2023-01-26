<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Slider;
use Image;
use App\Models\Admins\ProductImage;

class SliderController extends Controller
{
    public function sliderView()
    {

        $sliders = Slider::latest()->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'slider_title' => 'required|min:4',
            'slider_decription' => 'required',
            'slider_image' => 'required'

        ], [
            'slider_title.required' => 'Invalid input'
        ]);
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('sliders/' . $name_gen);
        $save_url = 'sliders/' . $name_gen;
        $slider = new Slider();
        $slider->slider_img = $save_url;
        $slider->title = $request->slider_title;
        $slider->description = $request->slider_description;
        $slider->save();
        $notification = array('message' => 'Slider recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.edit', compact('slider'));
    }
    public function delete($id)
    {
        $slider = Slider::findOrFail($id);
        unlink($slider->slider_img);
        $slider->delete();
        $notification = array('message' => 'Slide deleted', 'alert-type' => 'success');
        return redirect()->route('admin.manage.sliders')->with($notification);
    }
    public function update(Request $request, $id)
    {
        $slide_id = $request->id;
        $old_img = $request->old_image;
        if ($request->file('slider_image')) {
            $image = $request->file('slider_image');
            unlink($old_img);
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('sliders/' . $name_gen);
            $save_url = 'sliders/' . $name_gen;
            Slider::findOrFail($slide_id)->update([
                'slider_img' => $save_url,
                'title' => $request->slider_title,
                'description' => $request->slider_decription
            ]);
            $notification = array('message' => 'Slider updated', 'alert-type' => 'info');
            return redirect()->route('admin.manage.sliders')->with($notification);
        } else {
            Slider::findOrFail($slide_id)->update([
                'title' => $request->slider_title,
                'description' => $request->slider_decription
            ]);
            $notification = array('message' => 'Slider updated', 'alert-type' => 'info');
            return redirect()->route('admin.manage.sliders')->with($notification);
        }
    }
    public function SliderInactive($id)
    {
        Slider::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Slider Inactive',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }


    public function SliderActive($id)
    {
        Slider::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Slider Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
