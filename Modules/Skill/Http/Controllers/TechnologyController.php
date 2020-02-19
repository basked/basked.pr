<?php

namespace Modules\Skill\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Skill\Entities\Technology;
use Modules\Skill\Entities\Technology\Type;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $columns = Technology::getColumns();
        $captions = Technology::getColumnsWithCaptions();
        return view('skill::technologies.index', ['columns' => $columns,'captions'=>$captions]);
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


    /**
     * Test data
     *
     */
    public function test()
    {
   //   return Technology::getLanguagesSite();
  // Technology::reloadTechnologiesSite();
        $technologies= Type::find(1)->technologies;
     foreach ($technologies as $t){
         echo  $t->name.'<br>';
     }
        //   dd(Technology::find(1)->name,Technology::find(1)->types->find(1)->name);

    }

}