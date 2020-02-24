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

Route::group(['prefix' => 'user'], function () {
	Route::post('login', 'API\UserController@login');
	Route::post('register', 'API\UserController@register');
});

Route::group(['middleware' => 'auth:api'], function(){
	
	Route::get('index', 'API\UserController@index');
	
});


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
