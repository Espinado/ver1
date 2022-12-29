<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\SubCategory;
use App\Models\Admins\Category;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();;
        $subcategories = SubCategory::latest()->get();
        return view('admin.subcategories.index', compact('subcategories', 'categories'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'subcategory_name'    => 'required',
                'subcategory_icon' => 'required',
                'category_id' => 'required',

            ],
            [
                'category_name.required'    => 'Incorrect category name',
                'category_icon.required'    => 'Incorrect category icon',
            ]
        );
        //TODO: validation to request
        //TODo data to json
        $subcategory = new Subcategory();
        $subcategory->icon = $request->subcategory_icon;
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->save();
        $notification = array('message' => 'Subcategory recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function edit_form($id)
    {
        $subcategory = Subcategory::FindOrFail($id);

        // $cat_array = json_decode($category->category_name);
        // foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
        //     if (!property_exists($cat_array, $properties['short'])) {
        //         $dev = $properties['short'];
        //         $cat_array->$dev = '';
        //     }
        // }
        //TODO back to json
        return view('admin.subcategories.subcat_edit_form', compact('subcategory'));
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'subcategory_name'    => 'required',
                'subcategory_icon' => 'required'
            ],
            [
                'subcategory_name.required'    => 'Incorrect category name',
                'subcategory_icon.required'    => 'Incorrect category icon',
            ]
        );
        Subcategory::where('id', $request->id)->update([
            'subcategory_name' => $request->subcategory_name,
            'icon' => $request->subcategory_icon
        ]);
        $notification = array('message' => 'Subcategory updated', 'alert-type' => 'success');
        return redirect('admin/subcategories')->with($notification);
    }
    public function delete($id)
    {
        Subcategory::FindOrFail($id)->delete();
        $notification = array('message' => 'Subcategory deleted', 'alert-type' => 'info');
        return redirect('admin/subcategories')->with($notification);
    }
}
