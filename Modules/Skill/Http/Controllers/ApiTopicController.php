<?php

namespace Modules\Skill\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Skill\Entities\Topic;
use Modules\Skill\Entities\Technology;
use Modules\Skill\Traits\TraitSkillDevModel;
use Str;
use Validator;

class ApiTopicController extends Controller
{
    use TraitSkillDevModel;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->getApiModel($request, Topic::class, []);
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
        $v = Validator::make($request->all(), [
            // 'name' => 'required|unique:spr_countries,name',
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {
            $topic = new Topic();
            $topic->id = $request->id;
            $topic->technology_id = $request->technology_id;
            $topic->name = $request->name;
            $topic->slug = Str::slug($request->name, '-');
            $topic->descr = $request->descr;
            $topic->save();
        }
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
        $topic = Topic::find($id);
        $topic->update();
        $topic->id = is_null($request->id) ? $topic->id : $request->id;
        $topic->name = is_null($request->name) ? $topic->name : $request->name;
        $topic->slug = Str::slug(is_null($request->name) ? $topic->name : $request->name, '-');
        $topic->technology_id = is_null($request->technology_id) ? $topic->technology_id : $request->technology_id;
        $topic->descr = is_null($request->descr) ? $topic->descr : $request->descr;
        $topic->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Topic::destroy([$id]);
    }



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function lookTechnologies()
    {
        $data['data'] = Technology::all('id', 'name')->toArray();
        return $data;
    }
}
