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
Route::get('products','ProductContrlloer@index')->name('products.index');
Route::get('products/create','ProductContrlloer@create')->name('products.create');
Route::post('products/store','ProductContrlloer@store')->name('products.store');
Route::delete('products/destroy','ProductContrlloer@destroy')->name('products.destroy');
// Route::post('products/delete','ProductContrlloer@delete')->name('products.delete');
Route::put('products/update','ProductContrlloer@update')->name('products.update');
Route::get('products/show','ProductContrlloer@show')->name('products.show');
Route::get('products/edit','ProductContrlloer@edit')->name('products.edit');



Route::get('/', function () {
    return view('welcome');
});
