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

    Route::get('/unit/{params?}', 'ApiUnitController@index');
    Route::post('/unit/', 'ApiUnitController@store');
    Route::put('/unit/{id}', 'ApiUnitController@update');
    Route::delete('/unit/{id}', 'ApiUnitController@destroy');


    Route::get('/countries/{id}/attributes', 'ApiCountryController@attributes');
    Route::get('/countries/{id}/details', 'ApiCountryController@details');
    Route::get( '/countries/{params?}', 'ApiCountryController@index');
    Route::post('/countries/', 'ApiCountryController@store');
    Route::put( '/countries/{id}', 'ApiCountryController@update');
    Route::delete('/countries/{id}', 'ApiCountryController@destroy');


});





