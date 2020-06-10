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
    Route::get('/technologies/print-tree/', 'TechnologyController@printTree');
    Route::get('/technologies/print-tree-data/', 'TechnologyController@treeData');
    Route::get('/technologies/print-tree-template/', 'TechnologyController@printTreeTemplate');
    Route::get('/technologies', 'TechnologyController@index');
    Route::get('/test-technologies/', 'TechnologyController@test');


    /*TYPE ROUTERS*/
    Route::get('/types', 'TypeController@index');
    Route::get('/test-types/', 'TypeController@test');


    /*DEVELOPER ROUTERS*/
    Route::get('/developers', 'DeveloperController@index');
    Route::get('/test-developers/', 'DeveloperController@test');


    /*ROADMAPS ROUTERS*/
    Route::get('/roadmaps', 'RoadmapController@index');
    Route::get('/test-roadmaps/', 'RoadmapController@test');

    /*TOPICS  ROUTERS*/
    Route::get('/topics/', 'TopicController@index');
    Route::get('/technology/{technology_id}/topics', 'TopicController@topicsWithTechnology');
    Route::get('/test-topics/{technology_id}', 'TopicController@test');


    /*EXAMPLES  ROUTERS*/
    Route::get('/examples', 'ExampleController@index');
    Route::get('/test-examples/', 'ExampleController@test');




    /*EXAMPLES  ROUTERS*/
    Route::get('/links', 'LinkController@index');
    Route::get('/test-links/', 'LinkController@test');



    /*BLOCK CODE  ROUTERS*/
    Route::get('/test-block-code/', function (){
        return view('skill::tests.index');
    });



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


  /*TEST */
    Route::get('/test','TestController@index');
    Route::get('/test-list-links','TestController@listLinks');
    Route::get('/test-devextreme','TestController@testDevExtreme');
    Route::get('/test-devextreme','TestController@testDevExtreme');
    //Data Layers
    Route::get('/test-data-layer-array','TestController@testArrayData');


});
