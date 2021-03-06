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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware'=>"auth"],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/categories','CategoryController');
    Route::resource('/posts','PostController');
    Route::resource('/tags','TagController');
    Route::get('/trashed-posts', 'PostController@trashed')->name('trashed.index');
    Route::get('/trashed-posts/{id}','PostController@restore')
                                    ->name('trashed.restore');
    
});
