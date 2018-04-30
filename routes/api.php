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

// //list movies:
// Route::get('movies', 'MovieController@index');
// //show single movie:
// Route::get('movie/{id}', 'MovieController@show');
// //Create new:
// Route::post('movie', 'MovieController@store');
// //update:
// Route::put('movie', 'MovieController@store');

Route::group(['prefix' => 'v1'],function(){
    Route::apiResource('movies', 'MovieController');
    //delete:
    //(not sure why delete request from Route::resource() goes to an err )
    Route::delete('/movies/{id}', 'MovieController@destroy');
});