<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Product;

class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware('admin');
    }

    public function index()
    {

        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function productView($id) {
        dd($id);
    }
    public function productAdd() {
        return view('admin.products.add_product');

    }
}
