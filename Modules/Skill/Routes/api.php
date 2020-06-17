<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Api\Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api\Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Api\Api" middleware group. Enjoy building your Api\Api!
|
*/

//Route::middleware('auth:Api\Api')->get('/skill', function (Request $request) {
//    return $request->user();
//});


Route::prefix('skill')->group(  function () {

    /*TECHNOLOGIES Api\Api ROUTERS*/
    Route::get('/technologies/print-tree-data/', 'Api\ApiTechnologyController@treeData');
    Route::get('/technologies/look-technologies/', 'Api\ApiTechnologyController@lookTechnologies');
    Route::get('/technologies/{params?}', 'Api\ApiTechnologyController@index');
    Route::post('/technologies/', 'Api\ApiTechnologyController@store');
    Route::put('/technologies/{id}', 'Api\ApiTechnologyController@update');
    Route::delete('/technologies/{id}', 'Api\ApiTechnologyController@destroy');
    Route::put('/technologies/reset-type/{id}','Api\ApiTechnologyController@resetType');
    Route::put('/technologies/reset-category/{id}','Api\ApiTechnologyController@resetCategory');

    /*TYPES Api\Api ROUTERS*/
    Route::get('/types/look-types/{params?}', 'Api\ApiTypeController@lookTypes');
    Route::get('/types/{params?}', 'Api\ApiTypeController@index');
    Route::post('/types/', 'Api\ApiTypeController@store');
    Route::put('/types/{id}', 'Api\ApiTypeController@update');
    Route::delete('/types/{id}', 'Api\ApiTypeController@destroy');


    /*DEVELOPERS Api\Api ROUTERS*/
    Route::get('/developers/{params?}/', 'Api\ApiDeveloperController@index');
    Route::post('/developers/', 'Api\ApiDeveloperController@store');
    Route::put('/developers/{id}', 'Api\ApiDeveloperController@update');
    Route::delete('/developers/{id}', 'Api\ApiDeveloperController@destroy');

    /*ROADMAPS Api\Api ROUTERS*/
    Route::get('/roadmaps/{id}/technologies', 'Api\ApiRoadmapController@technologies');
    Route::get('/roadmaps/look-developers', 'Api\ApiRoadmapController@lookDevelopers');
    Route::get('/roadmaps/look-technologies', 'Api\ApiRoadmapController@lookTechnologies');
    Route::get('/roadmaps/{params?}', 'Api\ApiRoadmapController@index');
    Route::post('/roadmaps/', 'Api\ApiRoadmapController@store');

     // для работы с pivot таблицей TechnologyRoadmap
    Route::post('/roadmaps/{id}/insert-technologies', 'Api\ApiRoadmapController@insertTechnology');
    Route::delete('/roadmaps/{id}/delete-technologies/{technology_id}', 'Api\ApiRoadmapController@deleteTechnology');
    Route::put('/roadmaps/{id}/update-technologies/{technology_id}', 'Api\ApiRoadmapController@updateTechnology');
    Route::put('/roadmaps/{id}', 'Api\ApiRoadmapController@update');
    Route::delete('/roadmaps/{id}', 'Api\ApiRoadmapController@destroy');
    Route::put('/roadmaps/reset-developer/{id}','Api\ApiRoadmapController@resetDeveloper');


    /*TOPICS PI ROUTERS*/
    Route::get('/topics/look-technologies', 'Api\ApiTopicController@lookTechnologies');
    Route::get('/topics/{params?}', 'Api\ApiTopicController@index');
    Route::get('/technology/{technology_id}/topics', 'Api\ApiTopicController@topicsWithTechnology');
    Route::post('/topics/', 'Api\ApiTopicController@store');
    Route::put('/topics/{id}', 'Api\ApiTopicController@update');
    Route::delete('/topics/{id}', 'Api\ApiTopicController@destroy');

    // для работы с detail таблицей Examples
    Route::get('/topic/{topic_id}/examples', 'Api\ApiExampleController@examples');
    Route::post('/topic/{topic_id}/insert-examples', 'Api\ApiExampleController@insertExample');
    Route::delete('/topic/{topic_id}/delete-examples/{example_id}', 'Api\ApiExampleController@deleteExample');
    Route::put('/topic/{topic_id}/update-examples/{example_id}', 'Api\ApiExampleController@updateExample');

    // для работы с detail таблицей Links
    Route::get('/topic/{topic_id}/links', 'Api\ApiLinkController@links');
    Route::post('/topic/{topic_id}/insert-links', 'Api\ApiLinkController@insertLink');
    Route::delete('/topic/{topic_id}/delete-links/{link_id}', 'Api\ApiLinkController@deleteLink');
    Route::put('/topic/{topic_id}/update-links/{link_id}', 'Api\ApiLinkController@updateLink');

    // для работы с тестовыми данными
    Route::get('/test-list-links', 'Api\ApiTestController@listLinks');
    Route::get('/test-search-lookup/{key}', 'Api\ApiTestController@searchLookup');
    Route::get('/test-search-lookup/{key}', 'Api\ApiTestController@searchLookup');
    /*для тестирования devextreme for php*/

    Route::resource('/test-dev-php-load','Api\ApiTestController');



});
