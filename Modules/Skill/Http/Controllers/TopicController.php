<?php

namespace Modules\Skill\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Skill\Entities\Technology;
use Modules\Skill\Entities\Topic;


class TopicController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $columns = Topic::getColumns();
        $captions = Topic::getColumnsWithCaptions();
        return view('skill::topics.index', ['columns' => $columns,'captions'=>$captions,'technology_id'=>0]);
    }

    /**
     * Display a listing of the resource if route technology/{technology_id}/topics.
     * @return Response
     */
    public function topicsWithTechnology($technology_id){
        $columns = Topic::getColumns();
        $captions = Topic::getColumnsWithCaptions();
        return view('skill::topics.index', ['columns' => $columns,'captions'=>$captions,'technology_id'=>$technology_id]);
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
    public function test(Request $technology_id){
        dd($technology_id);
        $topic_techs=Technology::find(118)->topics;
        foreach ($topic_techs as $tech){
           echo $tech->name.'<br>';
        }
         echo '<hr>';
         echo Topic::find(1)->technology->name;

    }
}
