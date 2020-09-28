<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

// Route for user role
Route::get('/','HomeController@index' );
Route::get('/trang-chu','HomeController@index');
Route::get('/category/{category_id}','CategoryProductController@show_category_home');
Route::get('/brand/{brand_id}','BrandProductController@show_brand_home');
Route::get('/product-detail/{product_id}','ProductController@details_product');

// cart
Route::post('/save-cart','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-cart/{rowId}','CartController@delete_cart');
Route::post('/update-cart','CartController@update_cart');

// Route for admin role
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@log_in');
Route::get('/logout','AdminController@log_out');

// Check out
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');

//Category
Route::get('/add-category-product','CategoryProductController@add_category_product');
Route::get('/all-category-product','CategoryProductController@all_category_product');
Route::post('/save-category-product','CategoryProductController@save_category_product');
Route::get('/active-category-product/{category_id}','CategoryProductController@active_category_product');
Route::get('/unactive-category-product/{category_id}','CategoryProductController@unactive_category_product');
Route::get('/edit-category-product/{category_id}','CategoryProductController@edit_category_product');
Route::get('/delete-category-product/{category_id}','CategoryProductController@delete_category_product');
Route::post('/update-category-product/{category_id}','CategoryProductController@update_category_product');

//Brand
Route::get('/add-brand-product','BrandProductController@add_brand_product');
Route::get('/all-brand-product','BrandProductController@all_brand_product');
Route::post('/save-brand-product','BrandProductController@save_brand_product');
Route::get('/active-brand-product/{brand_id}','BrandProductController@active_brand_product');
Route::get('/unactive-brand-product/{brand_id}','BrandProductController@unactive_brand_product');
Route::get('/edit-brand-product/{brand_id}','BrandProductController@edit_brand_product');
Route::get('/delete-brand-product/{brand_id}','BrandProductController@delete_brand_product');
Route::post('/update-brand-product/{brand_id}','BrandProductController@update_brand_product');

//Product
Route::get('/add-product','ProductController@add_product');
Route::get('/all-product','ProductController@all_product');
Route::post('/save-product','ProductController@save_product');
Route::get('/active-product/{product_id}','ProductController@active_product');
Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::post('/update-product/{product_id}','ProductController@update_product');


?>