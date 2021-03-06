<?php

namespace Modules\Skill\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Skill\Entities\Example;
use Modules\Skill\Entities\Topic;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $columns = Example::getColumns();
        $captions = Example::getColumnsWithCaptions();
        return view('skill::examples.index', ['columns' => $columns,'captions'=>$captions]);
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
     *  Test function for Topic Model
     *
     * */
    public function test(){
        $examples=Topic::find(1)->examples;
        foreach ($examples as $example){
            echo $example->name.'->'.$example->code.'<br>';
        }
        echo '<hr>';
        echo Example::find(1)->topic->name;

    }
}
