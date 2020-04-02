<?php

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

// Route::get('/', 'HomeController@index');

// Route::post('/create','MessageController@create');

// Route::get('/message/{id}', 'MessageController@view');

Route::get('/','PagesController@index')->name('home');
Route::get('/about','PagesController@about');
Route::get('/contact','PagesController@contact');
Route::post('/query_by_capacity','OrdersController@queryByCapacity');
Route::post('/send_booking_info','OrdersController@saveBookingInfo');
Route::get('/show_orders','OrdersController@show');

// Route::get('/products','PagesController@products');
Route::post('/products/store_photo','ProductsController@store_photo')->name('products.store_photo');
Route::post('/products/store_multiple_photos','ProductsController@store_multiple_photos')->name('products.store_multiple_photos');
Route::resource('posts','PostsController');
Route::get('/news','PostsController@news');
Route::get('/solutions','PostsController@solutions');
Route::get('/writings','PostsController@writings');
Route::resource('products','ProductsController');
Route::post('/ckeditor/image_upload','CKEditorController@image_upload');
Route::get('/ckeditor/image_browse','CKEditorController@image_browse');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::post('/delete_user', 'DashboardController@delete_user');
Route::post('/make_admin', 'DashboardController@make_admin');

Route::get('/category', 'CategoriesController@index');
Route::get('/category_select', 'CategoriesController@select');
Route::get('/category_edit', 'CategoriesController@edit');
Route::post('/category_store', 'CategoriesController@store');
Route::post('/category_update/{id}', 'CategoriesController@update');
Route::post('/category_destroy/{id}', 'CategoriesController@destroy');

Route::post('/store_view', 'ViewsController@store');
Route::get('/views', 'ViewsController@show')->name('views');


Route::get('facebook', function () {
    return view('facebook');
});
Route::get('auth/facebook/redirect', 'Auth\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');

Route::get('auth/google/redirect', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');