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

Route::post('/create','MessageController@create');

Route::get('/message/{id}', 'MessageController@view');

Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/products','PagesController@products');

Route::resource('posts','PostsController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
