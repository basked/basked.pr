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


    Route::get('/country/{id}/attributes', 'ApiCountryController@attributes');
    Route::get( '/country/{params?}', 'ApiCountryController@index');
    Route::post('/country/', 'ApiCountryController@store');
    Route::put( '/country/{id}', 'ApiCountryController@update');
    Route::delete('/country/{id}', 'ApiCountryController@destroy');


});





