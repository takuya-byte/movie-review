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
Route::get('/show/{id}', 'ReviewController@show')->name('show');
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
