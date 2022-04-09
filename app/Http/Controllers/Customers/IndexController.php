<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Category;
use LaravelLocalization;

class IndexController extends Controller
{
    public function index() {

        if (in_array('ru', LaravelLocalization::getSupportedLanguagesKeys())) {
            dd( "Yes, design_id:  exits in array");
        }

        $categories = Category::where('parent_id', null)->get();
        return view('customers.index', compact ('categories'));

    }
}
