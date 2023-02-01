<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\SellerController;
use App\Http\Controllers\Admins\CategoryController;
use App\Http\Controllers\Admins\SubcategoryController;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Admins\BrandController;
use App\Http\Controllers\Admins\AdminProfileController;

use App\Http\Controllers\SellerController as Seller;

use App\Http\Controllers\Customers\IndexController;
use App\Http\Controllers\Customers\ProfileController;
use App\Http\Controllers\Customers\CartController;
use App\Http\Controllers\Admins\SliderController;


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

Route::get('/category/subcategory/ajax/{category_id}', [SubCategoryController::class, 'SubCategoryAjax']);
Route::get('/category/subsubcategory/ajax/{category_id}', [SubCategoryController::class, 'SubSubCategoryAjax']);
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/admin',
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
        Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete')->middleware('admin');

        Route::get('/subcategories', [SubcategoryController::class, 'SubCategoryIndex'])->name('admin.subcategories')->middleware('admin');
        Route::post('/subcategory/store', [SubcategoryController::class, 'SubCategoryStore'])->name('admin.subcategory.store')->middleware('admin');
        Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'SubCategoryEdit_form'])->name('admin.subcategory.edit')->middleware('admin');
        Route::post('/subcategory/update', [SubcategoryController::class, 'SubCategoryUpdate'])->name('admin.subcategory.update')->middleware('admin');
        Route::get('/subcategory/delete/{id}', [SubcategoryController::class, 'SubCategoryDelete'])->name('admin.subcategory.delete')->middleware('admin');

        Route::get('/subsubcategories', [SubcategoryController::class, 'SubSubCategoryIndex'])->name('admin.subsubcategories')->middleware('admin');
        Route::post('/subsubcategory/store', [SubcategoryController::class, 'SubSubCategoryStore'])->name('admin.subsubcategory.store')->middleware('admin');
        Route::get('/subsubcategory/edit/{id}', [SubcategoryController::class, 'SubSubCategoryEdit_form'])->name('admin.subsubcategory.edit')->middleware('admin');
        Route::post('/subsubcategory/update', [SubcategoryController::class, 'SubSubCategoryUpdate'])->name('admin.subsubcategory.update')->middleware('admin');
        Route::get('/subsubcategory/delete/{id}', [SubcategoryController::class, 'SubSubCategoryDelete'])->name('admin.subsubcategory.delete')->middleware('admin');




        Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands')->middleware('admin');
        Route::post('/brand/register', [BrandController::class, 'store'])->name('admin.brand.store')->middleware('admin');
        Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('admin.brand.update')->middleware('admin');
        Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit')->middleware('admin');
        Route::get('/brand/delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete')->middleware('admin');

        Route::get('/products', [ProductController::class, 'index'])->name('admin.products')->middleware('admin');
        Route::get('/manage/product/', [ProductController::class, 'index'])->name('admin.manage.products')->middleware('admin');
        Route::get('/add/product', [ProductController::class, 'productAdd'])->name('admin.add.products')->middleware('admin');
        Route::post('store/product', [ProductController::class, 'productStore'])->name('admin.product.store')->middleware('admin');
        Route::get('/edit/product/{id}', [ProductController::class, 'productEdit'])->name('admin.edit.products')->middleware('admin');
        Route::post('update/product', [ProductController::class, 'productUpdate'])->name('admin.product.update')->middleware('admin');
        Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('admin.product.delete');
        Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('admin.update.product.image');
        Route::get('/image/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('admin.delete.product.image');

        Route::get('/product/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('admin.product.inactive');
        Route::get('/product/active/{id}', [ProductController::class, 'ProductActive'])->name('admin.product.active');

        Route::get('/sliders', [SliderController::class, 'index'])->name('admin.sliders')->middleware('admin');
        Route::get('/manage/sliders', [SliderController::class, 'sliderView'])->name('admin.manage.sliders')->middleware('admin');
        Route::post('/slider/register', [SliderController::class, 'store'])->name('admin.slider.store')->middleware('admin');
        Route::post('/slider/update/{id}', [SliderController::class, 'update'])->name('admin.slider.update')->middleware('admin');
        Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('admin.slider.edit')->middleware('admin');
        Route::get('/slider/delete/{id}', [SliderController::class, 'delete'])->name('admin.slider.delete')->middleware('admin');
        Route::get('/slider/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('admin.slider.inactive');
        Route::get('/slider/active/{id}', [SliderController::class, 'SliderActive'])->name('admin.slider.active');



        Route::get('/sellers/companies', [SellerController::class, 'SellerCompanies'])->name('admin.sellers.companies')->middleware('admin');
        Route::get('/seller/register', [SellerController::class, 'SellerRegister'])->name('seller.register')->middleware('admin');
        Route::post('/seller/store', [SellerController::class, 'AdminRegisterCreate'])->name('seller.register.store')->middleware('admin');
        Route::get('/seller/view/{id}', [SellerController::class, 'SellerView'])->name('seller.company.view')->middleware('admin');
        Route::post('/seller/employee/store', [SellerController::class, 'SellerEmployeeStore'])->name('seller.employee.store')->middleware('admin');
        Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware('admin');
    }
);


//-----------Seller routes
Route::prefix('seller')->group(function () {

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
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'profileEdit'])->name('user.profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'profileUpdate'])->name('user.profile.update');
        Route::get('/password/change', [ProfileController::class, 'changePassword'])->name('user.change.password');
        Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('user.update.password');
        Route::get('/product/details/{id}/{slug}', [IndexController::class, 'productDetails'])->name('product.details');
        Route::get('/product/tag/{product_tag}', [IndexController::class, 'productTag'])->name('product.tag');
        Route::get('/product/subcategory/{id}/{subcategory_slug}', [IndexController::class, 'SubCategoryProductView'])->name('subcategory.product.view');
        Route::get('/product/subsubcategory/{id}/{subsubcategory_slug}', [IndexController::class, 'SubSubCategoryProductView'])->name('subsubcategory.product.view');
        Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);
        Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

        Route::get('add_wishlist/{id}', [CartController::class, 'add_wishlist'])->name('add_wishlist');
        require __DIR__ . '/auth.php';
    }
);
