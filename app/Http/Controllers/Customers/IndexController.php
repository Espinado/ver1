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

        // $categories = Category::with('childrenRecursive')->get();
        // $productIds=$categories->pluck('id')->toArray();
        // $products=Product::whereIn('category_id', $productIds)->get();
        //   return view('customers.index', compact ('categories', 'products'));

$products=Product::where('status', true)->get();

        return view('customers.index', compact( 'products'));

    }
}
