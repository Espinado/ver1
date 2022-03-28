<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Category;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;


class CategoryController extends Controller
{
    public function __construct()
    {

        $this->middleware('admin');
    }

    public function index()
    {
        $categories = Category::all();
        $locale = LaravelLocalization::GetCurrentLocale();

        return view('admin.categories.index', compact('categories', 'locale'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            "category_name"    => "required|array|min:3",
            "category_name.*"  => "required|min:3",
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return back()->with('error', $messages);
        } else {
            if ($request->parent_id) {
                $parent_id = $request->parent_id;
            } else {
                $parent_id = null;
            }
            $category = new Category;
            $category->parent_id = $parent_id;
            $category->category_name = json_encode($request->category_name);
            $category->save();
        }
    }
}
