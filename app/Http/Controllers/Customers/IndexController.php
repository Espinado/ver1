<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Category;
use LaravelLocalization;
use App\Helpers\CatMultilangArray;
use App\Models\Admins\Product;

class IndexController extends Controller
{
    public function index() {


        $categories = Category::with('childrenRecursive')->get();
        // dd($categories);
        $productIds=$categories->pluck('id')->toArray();
        // dd($productIds);
        $products=Product::whereIn('category_id', $productIds)->get();
        // dd($products);
        return view('customers.index', compact ('categories', 'products'));
    }
}
