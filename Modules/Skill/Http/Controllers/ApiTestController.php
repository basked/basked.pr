<?php

namespace Modules\Skill\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Skill\Entities\Test;
use Modules\Skill\Traits\TraitSkillDevModel;
use function MongoDB\BSON\toJSON;

class ApiTestController extends Controller
{


    use TraitSkillDevModel;
    protected $model;
    protected $fields;
    protected $request;
    protected $take_default = 5;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
      return $this->getApiModel($request, Test::class, []);
    }



    public function listLinks(Request $request)
    {
//        $test_data=Test::all()->toJson();
//        return $test_data;
  return $this->getApiModel($request, Test::class, []);
//        return Test::all()->toJson();
    }
    // Поиск для Lookup
    public function searchLookup($key){
      return Test::where('descr','like','%' . $key . '%')->get(['id','descr'])->toJson();
    }





    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('skill::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('skill::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('skill::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
