<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\SubCategory;
use App\Models\Admins\SubSubCategory;
use App\Models\Admins\Category;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function SubCategoryIndex()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();;
        $subcategories = SubCategory::latest()->get();
        return view('admin.subcategories.index', compact('subcategories', 'categories'));
    }
    public function SubCategoryStore(Request $request)
    {
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
    public function SubCategoryEdit_form($id)
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

    public function SubCategoryUpdate(Request $request)
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
    public function SubCategoryDelete($id)
    {
        Subcategory::FindOrFail($id)->delete();
        $notification = array('message' => 'Subcategory deleted', 'alert-type' => 'info');
        return redirect('admin/subcategories')->with($notification);
    }

    //------------------------------
    public function SubSubCategoryIndex()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();;
        $subsubcategories = SubSubCategory::latest()->get();
        return view('admin.subcategories.sub_subcategory_view', compact('subsubcategories', 'categories'));
    }
    public function SubCategoryAjax($category_id)
    {

        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);
    }
    public function SubSubCategoryAjax($subcategory_id)
    {

        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name', 'ASC')->get();
       
        return json_encode($subsubcat);
    }

    public function SubSubCategoryStore(Request $request)
    {

            $request->validate(
            [
                'subsubcategory_name'    => 'required',
                'subsubcategory_icon' => 'required',
                'subcategory_id' => 'required',

            ],
            [
                'subsubcategory_name.required'    => 'Incorrect category name',
                'subsubcategory_icon.required'    => 'Incorrect category icon',
            ]
        );
        //TODO: validation to request
        //TODo data to json
        $subsubcategory = new SubSubcategory();
        $subsubcategory->icon = $request->subsubcategory_icon;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subsubcategory_name = $request->subsubcategory_name;
        $subsubcategory->save();
        $notification = array('message' => 'Sub-Subcategory recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function SubSubCategoryEdit_form($id)
    {

        $categories=Category::orderBy('category_name', 'ASC')->get();
        $subcategories = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        $subsubcategory = SubSubcategory::FindOrFail($id);
        return view('admin.subcategories.subsubcat_edit_form', compact('subsubcategory', 'categories', 'subcategories'));
    }

    public function SubSubCategoryUpdate(Request $request)
    {
        $request->validate(
            [
                'subsubcategory_name'    => 'required',
                'subsubcategory_icon' => 'required',
                'subcategory_id'    => 'required',
                'category_id'    => 'required',
            ],
            [
                'subcategory_name.required'    => 'Incorrect category name',
                'subcategory_icon.required'    => 'Incorrect category icon',
            ]
        );
        SubSubcategory::where('id', $request->id)->update([
            'subsubcategory_name' => $request->subcategory_name,
            'icon' => $request->subcategory_icon,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
        ]);
        $notification = array('message' => 'Subsubcategory updated', 'alert-type' => 'success');
        return redirect('admin/subsubcategories')->with($notification);
    }
    public function SubSubCategoryDelete($id)
    {
        SubSubcategory::FindOrFail($id)->delete();
        $notification = array('message' => 'Subcategory deleted', 'alert-type' => 'info');
        return redirect('admin/subsubcategories')->with($notification);
    }

}
