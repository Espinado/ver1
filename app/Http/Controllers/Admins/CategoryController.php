<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Category;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;
use Image;



class CategoryController extends Controller
{
    public function __construct()
    {

        $this->middleware('admin');
    }

    public function index()
    {
        // $categories = Category::where('parent_id', null)->get();

        // $locale = LaravelLocalization::GetCurrentLocale();
        // foreach ($categories as $cat) {
        //     if (!property_exists(json_decode($cat->category_name), $locale)) {
        //         $locale = config('app.fallback_locale');
        //     }
        // }
        $categories = Category::latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'category_name'    => 'required',
                'category_icon' => 'required'
            ],
            [
                'category_name.required'    => 'Incorrect category name',
                'category_icon.required'    => 'Incorrect category icon',
            ]
        );
        //TODO: validation to request
        //TODo data to json
        $category = new Category();
        $category->icon = $request->category_icon;
        $category->category_name = $request->category_name;
        $category->save();
        $notification = array('message' => 'Category recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function edit_form($id)
    {
        $category = Category::FindOrFail($id);

        // $cat_array = json_decode($category->category_name);
        // foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
        //     if (!property_exists($cat_array, $properties['short'])) {
        //         $dev = $properties['short'];
        //         $cat_array->$dev = '';
        //     }
        // }
        //TODO back to json
        return view('admin.categories.cat_edit_form', compact('category'));
    }
    public function update(Request $request)
    {
        $request->validate(
            [
                'category_name'    => 'required',
                'category_icon' => 'required'
            ],
            [
                'category_name.required'    => 'Incorrect category name',
                'category_icon.required'    => 'Incorrect category icon',
            ]
        );
        Category::where('id', $request->id)->update([
            'category_name' => $request->category_name,
            'icon' => $request->category_icon
        ]);
        $notification = array('message' => 'Category recorded', 'alert-type' => 'success');
        return redirect('admin/categories')->with($notification);
    }

    public function delete($id)
    {
        Category::FindOrFail($id)->delete();
        $notification = array('message' => 'Category deleted', 'alert-type' => 'info');
        return redirect('admin/categories')->with($notification);
    }

}
