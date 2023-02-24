<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Category;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;
use Image;
use App\Http\Requests\Admin\CategoryRequest;



class CategoryController extends Controller
{
    public function __construct()
    {

        $this->middleware('admin');
    }

    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $validatedData = $request->validated();
        $category = new Category();
        $category->icon = $validatedData['category_icon'];
        $category->category_name = $validatedData['category_name'];
        $category->save();
        $notification = array('message' => 'Category recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function edit_form($id)
    {
        $category = Category::FindOrFail($id);
        return view('admin.categories.cat_edit_form', compact('category'));
    }
    public function update(CategoryRequest $request)
    {
        $validatedData = $request->validated();
        Category::where('id', $request->id)->update([
            'category_name' => $validatedData['category_name'],
            'icon' => $validatedData['category_icon']
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
