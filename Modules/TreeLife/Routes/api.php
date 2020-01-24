<?php

use Illuminate\Http\Request;
use Modules\TreeLife\Transformers\RelationshipResource;

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
/*
Route::middleware('auth:api')->get('/treelife', function (Request $request) {
    return $request->user();
});*/

Route::get('/treelife/{patams?}', 'ApiTreeLifeController@index');
Route::post('/treelife/', 'ApiTreeLifeController@store');
Route::put('/treelife/{id}', 'ApiTreeLifeController@update');
Route::delete('/treelife/{id}', 'ApiTreeLifeController@destroy');






