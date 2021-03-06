<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[App\Http\Controllers\FrontProductListController::class, 'index']);
Route::get('/product/{id}',[App\Http\Controllers\FrontProductListController::class, 'show']);

Route::get('/category/{name}',[App\Http\Controllers\FrontProductListController::class, 'allProduct']);
Route::get('/addToCart/{product}',[App\Http\Controllers\CartController::class, 'addToCart'])->name('add.cart');
Route::get('/cart',[App\Http\Controllers\CartController::class, 'showCart'])->name('cart.show');
Route::post('/products/{product}',[App\Http\Controllers\CartController::class, 'updateCart'])->name('cart.update');
Route::post('/product/{product}',[App\Http\Controllers\CartController::class, 'removeCart'])->name('cart.remove');
Route::get('/index/test',function() {
    return view('test');
});
Route::get('/checkout/{amount}',[App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout') ->middleware('auth');
Route::get('/orders',[App\Http\Controllers\CartController::class, 'order'])->name('order')->middleware('auth');
Route::post('/charge',[App\Http\Controllers\CartController::class, 'charge'])->name('cart.charge');

Auth::routes();
Route::get('all/products',[App\Http\Controllers\FrontProductListController::class, 'moreProducts'])->name('more.product');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix'=>'auth','middleware'=>['auth','isAdmin']],function(){
    Route::get('/dashboard',function(){
        return view('admin.dashboard');
    });
//To View Order
    
//Category
    Route::post('/category/create',[App\Http\Controllers\CategoryController::class, 'store']);
    Route::get('/category/create',[App\Http\Controllers\CategoryController::class, 'create']);
    Route::post('/category/update/{id}',[App\Http\Controllers\CategoryController::class, 'update']);
    Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
    Route::get('/category/index',[App\Http\Controllers\CategoryController::class, 'index']);
    Route::post('/category/delete/{id}',[App\Http\Controllers\CategoryController::class, 'destroy']);
//SubCategory 
    Route::post('/subcategory/create',[App\Http\Controllers\SubCategoryController::class, 'store']);
    Route::get('/subcategory/create',[App\Http\Controllers\SubCategoryController::class, 'create']);
    Route::post('/subcategory/update/{id}',[App\Http\Controllers\SubCategoryController::class, 'update']);
    Route::get('/subcategory/edit/{id}', [App\Http\Controllers\SubCategoryController::class, 'edit']);
    Route::get('/subcategory/index',[App\Http\Controllers\SubCategoryController::class, 'index']);
    Route::post('/subcategory/delete/{id}',[App\Http\Controllers\SubCategoryController::class, 'destroy']);
//Product 
    Route::post('/product/create',[App\Http\Controllers\ProductController::class, 'store']);
    Route::get('/product/create',[App\Http\Controllers\ProductController::class, 'create']);
    Route::post('/product/update/{id}',[App\Http\Controllers\ProductController::class, 'update']);
    Route::get('/product/edit/{id}',[App\Http\Controllers\ProductController::class, 'edit']);
    Route::get('/product/index',[App\Http\Controllers\ProductController::class, 'index']);
    Route::post('/product/delete/{id}',[App\Http\Controllers\ProductController::class, 'destroy']);
//In Product to get Subcategory based on choosen Category
    Route::get('/subcategories/{id}',[App\Http\Controllers\ProductController::class, 'loadSubCategories']);
//Slider 
    Route::post('/slider/create',[App\Http\Controllers\SliderController::class, 'store']);
    Route::get('/slider/create',[App\Http\Controllers\SliderController::class, 'create']);
    Route::get('/slider/index',[App\Http\Controllers\SliderController::class, 'index']);
    Route::delete('slider/{id}',[App\Http\Controllers\SliderController::class, 'destroy'])->name('slider.destroy');

});



