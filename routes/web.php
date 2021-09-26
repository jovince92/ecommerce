<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\main\HomeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ShippingAreaController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\main\CartController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\WhistlistController;
use Carbon\Carbon as CarbonCarbon;

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


Route::get('/', [HomeController::class, 'index']); 


Route::middleware(['user','auth'])->group(function(){
    Route::get('/profile', [HomeController::class, 'show'])->name('profile');    
    Route::post('/update', [HomeController::class, 'store'])->name('update');    
    Route::get('/changepassword', [HomeController::class, 'passwordShow'])->name('password.show');    
    Route::post('/updatepassword', [HomeController::class, 'passwordStore'])->name('password.store');    
    Route::get('/orderhistory', [DashboardController::class, 'orders'])->name('order.history');    
    Route::get('/orderdetails/{id}/{invoice?}', [DashboardController::class, 'orders_show'])->name('order.show');    
    Route::get('/cancel/{id}', [DashboardController::class, 'cancelorder'])->name('order.cancel');    
    Route::post('/return/', [DashboardController::class, 'returnrequest'])->name('order.return');    


    
});


Route::prefix('blog')->group(function(){
    Route::get('/',[BlogController::class,'frontpageblogs_index'])->name('blogs.frontpage.all');
    Route::get('/details/{slug}',[BlogController::class,'frontpageblogs_show'])->name('blogs.frontpage.details');
});






Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);    
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
    
});


Route::prefix('admin')->middleware(['auth:sanctum,admin', 'verified'])->middleware('auth:admin')->group(function () {
    Route::get('/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('admin.edit');
    Route::post('/edit', [ProfileController::class, 'store'])->name('admin.store');
    Route::post('/password', [ProfileController::class, 'storePassword'])->name('admin.store.password');

    /*************************************************** */
    Route::prefix('brand')->group(function(){
        Route::get('/view',[BrandController::class,'index'])->name('brand.all');
        Route::post('/create',[BrandController::class,'create'])->name('brand.store');
        Route::get('/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
        Route::post('/edit',[BrandController::class,'update'])->name('brand.update');
        Route::get('/delete/{id}',[BrandController::class,'delete'])->name('brand.delete');
    });

    /*************************************************** */
    Route::prefix('category')->group(function(){
        Route::get('/view',[CategoryController::class,'index'])->name('category.all');
        Route::post('/create',[CategoryController::class,'create'])->name('category.store');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('/edit',[CategoryController::class,'update'])->name('category.update');
        Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
        /*************************************************** */
        /*************************SUB*********************** */
        /*************************************************** */

        Route::get('/sub/view',[SubCategoryController::class,'index'])->name('category.sub.all');
        Route::post('/sub/create',[SubCategoryController::class,'create'])->name('category.sub.store');
        Route::get('/sub/edit/{id}',[SubCategoryController::class,'edit'])->name('category.sub.edit');
        Route::post('/sub/edit',[SubCategoryController::class,'update'])->name('category.sub.update');
        Route::get('/sub/delete/{id}',[SubCategoryController::class,'delete'])->name('category.sub.delete');
        /*************************************************** */
        /*************************SUB->SUB****************** */
        /*************************************************** */
        Route::get('/sub/sub/view',[SubCategoryController::class,'subIndex'])->name('category.sub.sub.all');
        Route::post('/sub/sub/create',[SubCategoryController::class,'subCreate'])->name('category.sub.sub.store');
        Route::get('/sub/sub/edit/{id}',[SubCategoryController::class,'subEdit'])->name('category.sub.sub.edit');
        Route::post('/sub/sub/edit',[SubCategoryController::class,'subUpdate'])->name('category.sub.sub.update');
        Route::get('/sub/sub/delete/{id}',[SubCategoryController::class,'subDelete'])->name('category.sub.sub.delete');
        /**********************AJAX************ */
        Route::get('/subcategory/ajax/{id}',[SubCategoryController::class,'getSubCategoryAjax']);
        Route::get('/subsubcategory/ajax/{id}',[SubCategoryController::class,'getSubSubCategoryAjax']);
    });

    Route::prefix('products')->group(function(){
        Route::get('/',[ProductController::class,'index'])->name('products.all');
        Route::get('/create',[ProductController::class,'create'])->name('products.create');
        Route::post('/store',[ProductController::class,'store'])->name('products.store');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('products.edit');
        Route::post('/update',[ProductController::class,'update'])->name('products.update');
        Route::get('/delete/{id}',[ProductController::class,'delete'])->name('products.delete');
        Route::get('/status/{id}',[ProductController::class,'status'])->name('products.status');
    });

    Route::prefix('sliders')->group(function(){
        Route::get('/',[SliderController::class,'index'])->name('sliders.all');
        Route::get('/status/{id}',[SliderController::class,'status'])->name('sliders.status');
        Route::post('/store',[SliderController::class,'store'])->name('sliders.store');
        Route::get('/edit/{id}',[SliderController::class,'edit'])->name('sliders.edit');
        Route::post('/update',[SliderController::class,'update'])->name('sliders.update');
        Route::get('/delete/{id}',[SliderController::class,'delete'])->name('sliders.delete');
    });


    Route::prefix('coupons')->group(function(){
        Route::get('/',[CouponController::class,'index'])->name('coupons.all');
        Route::post('/store',[CouponController::class,'store'])->name('coupons.store');
        Route::get('/edit/{id}',[CouponController::class,'edit'])->name('coupons.edit');
        Route::post('/update',[CouponController::class,'update'])->name('coupons.update');
        Route::get('/status/{id}',[CouponController::class,'status'])->name('coupons.status');
        Route::get('/delete/{id}',[CouponController::class,'delete'])->name('coupons.delete');
        
    });

    Route::prefix('shipping')->group(function(){
        Route::get('/cities',[ShippingAreaController::class,'cities_index'])->name('cities.all');;
        Route::get('/states/{id}',[ShippingAreaController::class,'states_ajax'])->name('states.all');;
        Route::get('/states_cities/{id}',[ShippingAreaController::class,'states_cities'])->name('states.table');
        Route::post('/cities/create',[ShippingAreaController::class,'cities_create'])->name('cities.create');
        Route::get('/cities/delete/{id}',[ShippingAreaController::class,'cities_delete'])->name('cities.delete');
        Route::get('/statuses/',[ShippingAreaController::class,'statuses_index'])->name('statuses.all');
    });


    Route::prefix('orders')->group(function(){
        Route::get('/pending',[OrderController::class,'pending'])->name('orders.pending');
        Route::get('/confirmed',[OrderController::class,'confirmed'])->name('orders.confirmed');
        Route::get('/inprogress',[OrderController::class,'inprogress'])->name('orders.inprogress');
        Route::get('/pickedup',[OrderController::class,'pickedup'])->name('orders.pickedup');
        Route::get('/shipped',[OrderController::class,'shipped'])->name('orders.shipped');
        Route::get('/delivered',[OrderController::class,'delivered'])->name('orders.delivered');
        Route::get('/cancelled',[OrderController::class,'cancelled'])->name('orders.cancelled');
        Route::get('/returned',[OrderController::class,'returned'])->name('orders.returned');


        Route::get('/details/{id}',[OrderController::class,'show'])->name('orders.show_admin');;
        Route::get('/status/{id}',[OrderController::class,'update'])->name('orders.update_status');;
        Route::get('/cancel/{id}',[OrderController::class,'cancel'])->name('orders.admin_cancel');;
    });


    Route::prefix('blog')->group(function(){
        Route::get('/',[BlogController::class,'index'])->name('blogs.all');;
        Route::get('/create',[BlogController::class,'create'])->name('blogs.create');;
        Route::post('/store',[BlogController::class,'store'])->name('blogs.store');;
        Route::post('/update',[BlogController::class,'update'])->name('blogs.update');;
        Route::get('/delete/{id}',[BlogController::class,'delete'])->name('blogs.delete');;
        Route::get('/edit/{id}',[BlogController::class,'edit'])->name('blogs.edit');;
    });

    Route::prefix('settings')->group(function(){
        Route::get('/',[SettingsController::class,'index'])->name('settings.index');;
        Route::post('/update',[SettingsController::class,'update'])->name('settings.update');;
        Route::get('/seo',[SettingsController::class,'seo'])->name('settings.seo');;
        Route::post('/seo/update',[SettingsController::class,'update_seo'])->name('settings.update_seo');;
    });

    Route::prefix('reviews')->group(function(){
        Route::get('/',[ReviewController::class,'index'])->name('review.admin_index');
        Route::get('/approve/{id}',[ReviewController::class,'approve'])->name('review.admin_approve');
    });
    


    Route::get('/reports',[ReportController::class,'reports'])->name('reports.all');
    Route::post('/reports/generate',[ReportController::class,'generatereports'])->name('reports.generate');
    

    

    Route::prefix('accounts')->group(function(){
        Route::get('/useraccounts',[AdminController::class,'useraccounts'])->name('users.all');
        Route::get('/employees',[AdminController::class,'employees_index'])->name('employees.all');
        Route::get('/employees/create',[AdminController::class,'employees_create'])->name('employees.create');
        Route::post('/employees/store',[AdminController::class,'employees_store'])->name('employees.store');
        Route::get('/employees/delete/{id}',[AdminController::class,'employees_delete'])->name('employees.delete');
        Route::get('/employees/edit/{id}',[AdminController::class,'employees_edit'])->name('employees.edit');
        Route::post('/employees/update',[AdminController::class,'employees_update'])->name('employees.update');
    });

}); //ADMIN ROUTES END HERE


Route::get('/checkout/states/{id}',[ShippingAreaController::class,'states_ajax']);
Route::get('/checkout/cities/{id}',[ShippingAreaController::class,'cities_all']);


Route::prefix('products')->group(function(){
    Route::get('/details/{slug}',[HomeController::class,'productsShow'])->name('main.product.details');
    Route::get('/subsubcategorized/{subsubslug}',[HomeController::class,'productsSubSubCategorized'])->name('main.product.subsubcategorized');
    Route::get('/subcategorized/{subslug}',[HomeController::class,'productsSubCategorized'])->name('main.product.subcategorized');
    Route::get('/categorized/{catslug}',[HomeController::class,'productsCategorized'])->name('main.product.categorized');

    /***********AJAX******* */
    Route::get('/cart/{slug}',[HomeController::class,'productsCart'])->name('main.product.cart_get');
});






Route::get('/admin/dashboard',[AdminController::class,'index'])
    ->middleware(['auth:sanctum,admin', 'verified'])
    ->middleware('auth:admin')
    ->name('dashboard');

// Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
//     return view('admin.index');
// })->name('dashboard')->middleware('auth:admin');



Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');




Route::get('/language/{lang}',[LanguageController::class,'index'])->name('language');




Route::prefix('cart')->group(function(){
    Route::post('/add',[CartController::class,'add'])->name('cart.add');
    Route::get('/header',[CartController::class,'headerCart'])->name('cart.header');
    Route::get('/remove/{rowId}',[CartController::class,'remove'])->name('cart.remove');
    Route::get('/clear',[CartController::class,'clear'])->name('cart.clear');    
    Route::get('/mycart',[CartController::class,'index'])->name('cart.index');    
    Route::get('/mycart/show',[CartController::class,'show'])->name('cart.show');    
    Route::post('/update',[CartController::class,'update'])->name('cart.update');
    Route::post('/coupon_ajax',[CartController::class,'apply'])->name('coupons.apply');
    Route::get('/coupon_ajax2',[CartController::class,'applied'])->name('coupons.applied');
    Route::get('/coupon_ajax3',[CartController::class,'couponRemove'])->name('coupons.removeAjax');
    Route::get('/checkout',[CartController::class,'checkout'])->name('checkout');
    Route::post('/checkout_proceed',[CheckoutController::class,'checkout_store'])->middleware(['user','auth'])->name('checkout.store');
});


Route::prefix('payment')->middleware(['user','auth'])->group(function(){
    Route::post('/stripe',[CheckoutController::class,'stripe'])->name('payments.stripe');
    Route::get('/paymentsuccessful/{id}',[CheckoutController::class,'paymentsuccess'])->name('payments.success');

});



Route::prefix('wishlist')->group(function(){
    Route::post('/add',[WhistlistController::class,'add'])->name('wishlist.add');
    Route::get('/',[WhistlistController::class,'index'])->middleware(['user','auth'])->name('wishlist.all');
    Route::get('/show',[WhistlistController::class,'show'])->name('wishlist.show');
    Route::post('/delete',[WhistlistController::class,'delete'])->name('wishlist.delete');
    
});


Route::get('/ordertracking/',[HomeController::class,'ordertracking'])->middleware(['user','auth'])->name('ordertracking.all');
Route::get('/search/',[HomeController::class,'search'])->name('search.all');
Route::get('/search/brands/{slug}',[HomeController::class,'brands'])->name('brands.search');
Route::post('/search_product/',[HomeController::class,'search_ajax'])->name('search.ajax');
Route::get('/search/tags/',[HomeController::class,'tags'])->name('search.tags');


Route::post('/review',[ReviewController::class,'create'])->name('review.create');















//VIEW , ROUTE, and Method TESTING
Route::get('/testtest', function () {

    return 0;
    /*
        \Illuminate\Support\Facades\Cache::flush();
    */
    
//    $tags_en = App\Models\Product::distinct()->get(['product_tags_en']);
//    return dd($tags_en);
});

//Route::get('test/',[ProductController::class,'test']);



