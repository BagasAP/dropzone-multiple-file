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
    return view('template.template');
});

//
Route::get('file','FileController@create');
Route::post('file','FileController@store');

Route::get('image/upload','FileController@fileCreate');
Route::post('image/upload/store','FileController@fileStore');
Route::post('image/delete','FileController@fileDestroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
