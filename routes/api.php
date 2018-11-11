<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/users', "UserController@getUsers");
    Route::get('/users/{id}', "UserController@show");
    Route::post('/users', "UserController@store");
    Route::patch('/users/{id}', "UserController@update");
    Route::delete('/users/{id}', "UserController@destroy");

    Route::get('/profile', "UserController@getProfile");
    Route::patch('/profile/{id}', "UserController@updateHobby");
});


