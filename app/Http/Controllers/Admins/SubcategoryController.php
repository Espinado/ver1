<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\SubCategory;
use App\Models\Admins\SubSubCategory;
use App\Models\Admins\Category;
use App\Http\Requests\Admin\SubCategoryRequest;
use App\Http\Requests\Admin\SubSubCategoryRequest;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function SubCategoryIndex()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        $subcategories = SubCategory::latest()->get();
        return view('admin.subcategories.index', compact('subcategories', 'categories'));
    }
    public function SubCategoryStore(SubCategoryRequest $request)
    {
        // dd($request->all());
        $validatedData = $request->validated();
        $subcategory = new Subcategory();
        $subcategory->icon = $validatedData['subcategory_icon'];
        $subcategory->category_id = $validatedData['category_id'];
        $subcategory->subcategory_name = $validatedData['subcategory_name'];
        $subcategory->save();
        $notification = array('message' => 'Subcategory recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function SubCategoryEdit_form($id)
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        $subcategory = Subcategory::FindOrFail($id);
        return view('admin.subcategories.subcat_edit_form', compact('subcategory'));
    }

    public function SubCategoryUpdate(SubCategoryRequest $request)
    {
        $validatedData = $request->validated();
        Subcategory::where('id', $request->id)->update([
            'subcategory_name' => $validatedData['subcategory_name'],
            'icon' => $validatedData['subcategory_icon']
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
        $subcategory = $subcat->map(function ($sub) {
            return
                collect([
                    'subcategory_name' => $sub->getTranslation('subcategory_name', app()->getlocale()),
                    'id' => $sub->id,
                ]);
        });
        return json_encode($subcategory);
    }
    public function SubSubCategoryAjax($subcategory_id)
    {

        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name', 'ASC')->get();
        $subsubcategory = $subsubcat->map(function ($subsub) {
            return
                collect([
                    'subsubcategory_name' => $subsub->getTranslation('subsubcategory_name', app()->getlocale()),
                    'id' => $subsub->id,
                ]);
        });

        return json_encode($subsubcategory);
    }

    public function SubSubCategoryStore(SubSubCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $subsubcategory = new SubSubcategory();
        $subsubcategory->icon = $validatedData['subsubcategory_icon'];
        $subsubcategory->subcategory_id = $validatedData['subcategory_id'];
        $subsubcategory->category_id = $validatedData['category_id'];
        $subsubcategory->subsubcategory_name = $validatedData['subsubcategory_name'];
        $subsubcategory->save();
        $notification = array('message' => 'Sub-Subcategory recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function SubSubCategoryEdit_form($id)
    {

        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategories = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        $subsubcategory = SubSubcategory::FindOrFail($id);
        return view('admin.subcategories.subsubcat_edit_form', compact('subsubcategory', 'categories', 'subcategories'));
    }

    public function SubSubCategoryUpdate(SubSubCategoryRequest $request)
    {

        $validatedData = $request->validated();
        SubSubcategory::where('id', $request->id)->update([
            'subsubcategory_name' => $validatedData['subsubcategory_name'],
            'icon' => $validatedData['subsubcategory_icon'],
            'category_id' => $validatedData['category_id'],
            'subcategory_id' => $validatedData['subcategory_id'],
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
