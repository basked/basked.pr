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

    /*TECHNOLOGIES API ROUTERS*/
    Route::get('/technologies/print-tree-data/', 'ApiTechnologyController@treeData');
    Route::get('/technologies/look-technologies/', 'ApiTechnologyController@lookTechnologies');
    Route::get('/technologies/{params?}', 'ApiTechnologyController@index');
    Route::post('/technologies/', 'ApiTechnologyController@store');
    Route::put('/technologies/{id}', 'ApiTechnologyController@update');
    Route::delete('/technologies/{id}', 'ApiTechnologyController@destroy');
    Route::put('/technologies/reset-type/{id}','ApiTechnologyController@resetType');
    Route::put('/technologies/reset-category/{id}','ApiTechnologyController@resetCategory');

    /*TYPES API ROUTERS*/
    Route::get('/types/look-types/{params?}', 'ApiTypeController@lookTypes');
    Route::get('/types/{params?}', 'ApiTypeController@index');
    Route::post('/types/', 'ApiTypeController@store');
    Route::put('/types/{id}', 'ApiTypeController@update');
    Route::delete('/types/{id}', 'ApiTypeController@destroy');


    /*DEVELOPERS API ROUTERS*/
    Route::get('/developers/{params?}/', 'ApiDeveloperController@index');
    Route::post('/developers/', 'ApiDeveloperController@store');
    Route::put('/developers/{id}', 'ApiDeveloperController@update');
    Route::delete('/developers/{id}', 'ApiDeveloperController@destroy');

    /*ROADMAPS API ROUTERS*/
    Route::get('/roadmaps/{id}/technologies', 'ApiRoadmapController@technologies');
    Route::get('/roadmaps/look-developers', 'ApiRoadmapController@lookDevelopers');
    Route::get('/roadmaps/look-technologies', 'ApiRoadmapController@lookTechnologies');
    Route::get('/roadmaps/{params?}', 'ApiRoadmapController@index');
    Route::post('/roadmaps/', 'ApiRoadmapController@store');

     // для работы с pivot таблицей TechnologyRoadmap
    Route::post('/roadmaps/{id}/insert-technologies', 'ApiRoadmapController@insertTechnology');
    Route::delete('/roadmaps/{id}/delete-technologies/{technology_id}', 'ApiRoadmapController@deleteTechnology');
    Route::put('/roadmaps/{id}/update-technologies/{technology_id}', 'ApiRoadmapController@updateTechnology');
    Route::put('/roadmaps/{id}', 'ApiRoadmapController@update');
    Route::delete('/roadmaps/{id}', 'ApiRoadmapController@destroy');
    Route::put('/roadmaps/reset-developer/{id}','ApiRoadmapController@resetDeveloper');


    /*TOPICS PI ROUTERS*/
    Route::get('/topics/look-technologies', 'ApiTopicController@lookTechnologies');
    Route::get('/topics/{params?}', 'ApiTopicController@index');
    Route::get('/technology/{technology_id}/topics', 'ApiTopicController@topicsWithTechnology');
    Route::post('/topics/', 'ApiTopicController@store');
    Route::put('/topics/{id}', 'ApiTopicController@update');
    Route::delete('/topics/{id}', 'ApiTopicController@destroy');

    // для работы с detail таблицей Examples
    Route::get('/topic/{topic_id}/examples', 'ApiExampleController@examples');
    Route::post('/topic/{topic_id}/insert-examples', 'ApiExampleController@insertExample');
    Route::delete('/topic/{topic_id}/delete-examples/{example_id}', 'ApiExampleController@deleteExample');
    Route::put('/topic/{topic_id}/update-examples/{example_id}', 'ApiExampleController@updateExample');

    // для работы с detail таблицей Links
    Route::get('/topic/{topic_id}/links', 'ApiLinkController@links');
    Route::post('/topic/{topic_id}/insert-links', 'ApiLinkController@insertLink');
    Route::delete('/topic/{topic_id}/delete-links/{link_id}', 'ApiLinkController@deleteLink');
    Route::put('/topic/{topic_id}/update-links/{link_id}', 'ApiLinkController@updateLink');

    // для работы с тестовыми данными
    Route::get('/test-list-links', 'ApiTestController@listLinks');
    Route::get('/test-search-lookup/{key}', 'ApiTestController@searchLookup');
    Route::get('/test-search-lookup/{key}', 'ApiTestController@searchLookup');
    /*для тестирования devextreme for php*/

    Route::resource('/test-dev-php-load','ApiTestController');



});
