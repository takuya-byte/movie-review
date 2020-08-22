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

Route::get('/' , 'ReviewController@index')->name('index');

Auth::routes();



Route::group(['middleware' => ['auth']], function () {
    Route::get('/users/{id}', 'UsersController@show')->name('users.show');
});

Route::get('/show/{id}', 'ReviewController@show')->name('show');
Route::group(['middleware' => 'auth'], function () {

Route::put('/show/{id}', 'ReviewController@update')->name('update');

Route::delete('/show/{id}', 'ReviewController@destroy')->name('destroy');
Route::get('/show/{id}/edit', 'ReviewController@edit')->name('edit');
});
Route::group(['middleware' => 'auth'], function () {
Route::get('/review', 'ReviewController@create')->name('create');
Route::post('/review/store', 'ReviewController@store')->name('store');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::group(['prefix'=>'review/{id}'],function(){
       Route::post('favorite','FavoriteController@store')->name('favorites.favorite');
       Route::delete('unfavorite','FavoriteController@destroy')->name('favorites.unfavorite');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => '/users/{id}'], function () {
    Route::get('favorites', 'UsersController@favorites')->name('users.favorites');    // 追加
    });
});