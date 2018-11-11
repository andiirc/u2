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

Route::get('/users','UserController@index')->middleware('is-admin')->name('users');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::get('profile', 'UserController@profile')->name('profile');
