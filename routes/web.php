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


Auth::routes();

Route::get('/', 'MyServerController@index');
Route::post('/', 'MyServerController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('access-list/edit/{user}', 'AccessListController@edit')->name('ACL.edit');
Route::put('access-list/update/{user}', 'AccessListController@update')->name('ACL.update');