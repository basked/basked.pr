<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('directory')->group(function() {
    Route::get('/', 'ContinentController@index');
    Route::get('/autor', 'AutorController@index');

});
