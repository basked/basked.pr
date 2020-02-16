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

//Route::middleware('auth:api')->get('/skill', function (Request $request) {
//    return $request->user();
//});


Route::prefix('skill')->group(  function () {
    /*TECHNOLOGY API ROUTERS*/

    Route::get('/technologies/{params?}', 'ApiTechnologyController@index');
    Route::get('/technologies/{id?}/types', 'ApiTechnologyController@types');
    Route::post('/technologies/', 'ApiTechnologyController@store');
    Route::put('/technologies/{id}', 'ApiTechnologyController@update');
    Route::delete('/technologies/{id}', 'ApiTechnologyController@destroy');

    /*TYPE API ROUTERS*/
    Route::get('/types/{params?}', 'ApiTypeController@index');
    Route::post('/types/', 'ApiTypeController@store');
    Route::put('/types/{id}', 'ApiTypeController@update');
    Route::delete('/types/{id}', 'ApiTypeController@destroy');


});
