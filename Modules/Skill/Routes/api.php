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

    Route::get('/language/{params?}', 'ApiLanguageController@index');
    Route::post('/language/', 'ApiLanguageController@store');
    Route::put('/language/{id}', 'ApiLanguageController@update');
    Route::delete('/language/{id}', 'ApiLanguageController@destroy');


});
