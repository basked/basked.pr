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
//
//Route::middleware('auth:api')->get('/directory', function (Request $request) {
//    return $request->user();
//});




Route::get('/directory/unit/{patams?}', 'ApiUnitController@index');
Route::post('/directory/unit/', 'ApiUnitController@store');
Route::put('/directory/unit/{id}', 'ApiUnitController@update');
Route::delete('/directory/unit/{id}', 'ApiUnitController@destroy');
