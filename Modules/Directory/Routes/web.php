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


    /*UNIT ROUTERS*/

    Route::get('/unit', 'UnitController@index');


    /*COUNTRY ROUTERS*/
    Route::get('/country', 'CountryController@index');

    /*DIRECTORY ROUTERS*/
    Route::get('/', 'DirectoryController@index');


    Route::get('/autor', 'AutorController@index');



//  функции тестирования
    Route::get('/test-continent', 'ContinentController@test');
    Route::get('/test-country', 'CountryController@test');
    Route::get('/test-unit', 'UnitController@test');


});
