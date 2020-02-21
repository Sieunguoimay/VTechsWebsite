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

Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/contact','PagesController@contact');
// Route::get('/products','PagesController@products');
Route::post('products/store_photo','ProductsController@store_photo')->name('products.store_photo');
Route::resource('posts','PostsController');
Route::resource('products','ProductsController');
Route::post('/ckeditor/image_upload','CKEditorController@image_upload');
Route::get('/ckeditor/image_browse','CKEditorController@image_browse');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
