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
Route::prefix('directory')->group(  function () {

    Route::get('/unit/{params?}', 'Api\ApiUnitController@index');
    Route::post('/unit/', 'Api\ApiUnitController@store');
    Route::put('/unit/{id}', 'Api\ApiUnitController@update');
    Route::delete('/unit/{id}', 'Api\ApiUnitController@destroy');


    Route::get('/countries/{id}/attributes', 'Api\ApiCountryController@attributes');
    Route::get('/countries/{id}/details', 'Api\ApiCountryController@details');
    Route::get( '/countries/{params?}', 'Api\ApiCountryController@index');
    Route::post('/countries/', 'Api\ApiCountryController@store');
    Route::put( '/countries/{id}', 'Api\ApiCountryController@update');
    Route::delete('/countries/{id}', 'Api\ApiCountryController@destroy');


});





