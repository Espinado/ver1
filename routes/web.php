<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\SellerController;
use App\Http\Controllers\Admins\CategoryController;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Admins\BrandController;
use App\Http\Controllers\Admins\AdminProfileController;

use App\Http\Controllers\SellerController as Seller;

use App\Http\Controllers\Customers\IndexController;
use App\Http\Controllers\Customers\CartController;


use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//----------Admin Route

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/admin' ,
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        //  'namespace' => 'admin'
    ],
    function () {
        Route::get('/login', [AdminController::class, 'Index'])->name('login_form');
        Route::get('/register', [AdminController::class, 'AdminRegister'])->name('admin.register');
        Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
        Route::post('/register/create', [AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');
        Route::get('/', [AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
        Route::get('/admins', [AdminController::class, 'adminList'])->name('admin.admins')->middleware('admin');
        Route::get('admin/profile', [AdminProfileController::class, 'showProfile'])->name('admin.profile')->middleware('admin');
        Route::get('admin/profile/edit', [AdminProfileController::class, 'editProfile'])->name('admin.profile.edit')->middleware('admin');
        Route::post('admin/profile/update', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update')->middleware('admin');
        Route::get('admin/password/change', [AdminProfileController::class, 'changePassword'])->name('admin.change.password')->middleware('admin');
        Route::post('admin/password/update', [AdminProfileController::class, 'updatePassword'])->name('admin.update.password')->middleware('admin');

        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories')->middleware('admin');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store')->middleware('admin');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit_form'])->name('admin.category.edit')->middleware('admin');
        Route::post('/category/update', [CategoryController::class, 'update'])->name('admin.category.update')->middleware('admin');

        Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands')->middleware('admin');
        Route::post('/brand/register', [BrandController::class, 'store'])->name('admin.brand.store')->middleware('admin');

        Route::get('/products', [ProductController::class, 'index'])->name('admin.products')->middleware('admin');
        Route::get('/product/view/{id}',[ProductController::class, 'productView'])->name('product.view')->middleware('admin');
        Route::get('/product/add', [ProductController::class, 'productAdd'])->name('product.add')->middleware('admin');
        Route::post('/product/store', [ProductController::class, 'productStore'])->name('product.store')->middleware('admin');



        Route::get('/sellers/companies', [SellerController::class, 'SellerCompanies'])->name('admin.sellers.companies')->middleware('admin');
        Route::get('/seller/register', [SellerController::class, 'SellerRegister'])->name('seller.register')->middleware('admin');
        Route::post('/seller/store', [SellerController::class, 'AdminRegisterCreate'])->name('seller.register.store')->middleware('admin');
        Route::get('/seller/view/{id}', [SellerController::class, 'SellerView'])->name('seller.company.view')->middleware('admin');
        Route::post('/seller/employee/store', [SellerController::class, 'SellerEmployeeStore'])->name('seller.employee.store')->middleware('admin');
        Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware('admin');

    }
);


//-----------Seller routes
Route::prefix('seller')->group(function() {

    Route::post('/login/seller', [Seller::class, 'Login'])->name('seller.login');
     Route::get('/', [Seller::class, 'Dashboard'])->name('seller.dashboard')->middleware('seller');
    Route::get('/logout', [Seller::class, 'SellerLogout'])->name('seller.logout')->middleware('seller');
    Route::get('/accept/{token}/{invitee_id}', [Seller::class, 'ConfirmRegister'])->name('seller.invite.accept');
    Route::post('/confirmed/seller', [Seller::class, 'SellerConfirmed'])->name('seller.confirmed');
    Route::get('/confirmed/login/{email}/{password}', [Seller::class, 'LoginAfterConfirm'])->name('confirmed.login');





});

//--------End of admin route


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::get('add_wishlist/{id}', [CartController::class, 'add_wishlist'])->name('add_wishlist');
        require __DIR__ . '/auth.php';
    }
);





