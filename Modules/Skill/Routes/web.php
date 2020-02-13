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

Route::prefix('skill')->group(function() {

    /*TECHNOLOGY ROUTERS*/

    Route::get('/technologies', 'TechnologyController@index');
    Route::get('/test-technologies/', 'TechnologyController@test');




//   with param
    Route::get('/list', function () {
       echo "<br>skill/list";
    })->middleware(['first:1,2','second:3,4']);


//    Route::middleware(['bas' ])->group(function(){
//
//        Route::get('/list', function () {
//            "<br>skill/list";
//        });
//
//
//    });

    Route::get('/', 'SkillController@index');



});
