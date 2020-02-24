<?php

namespace Modules\Skill\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Skill\Entities\Technology;
use Modules\Skill\Traits\TraitSkillDevModel;

class ApiTechnologyController extends Controller
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
        return $this->getApiModel($request, Technology::class, []);
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
            $technology = new Technology();
            $technology->id = $request->id;
            $technology->name = $request->name;
            $technology->slug = Str::slug($request->name, '-');
            $technology->type_id = $request->type_id;
            $technology->descr = $request->descr;
            $technology->technology_id = $request->technology_id;
            $technology->save();
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
//        dd($request->all());
        $technology = Technology::find($id);
        $technology->id = is_null($request->id) ? $technology->id : $request->id;
        $technology->name = is_null($request->name) ? $technology->name : $request->name;
        $technology->slug = Str::slug(is_null($request->name) ? $technology->slug : $request->name, '-');
        $technology->type_id = is_null($request->type_id) ? $technology->type_id : $request->type_id;
        $technology->descr = is_null($request->descr) ? $technology->descr : $request->descr;
        $technology->technology_id = is_null($request->technology_id) ? $technology->technology_id : $request->technology_id;
        $technology->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Technology::destroy([$id]);
    }


    public function lookTechnologies()
    {
        $data['data'] = Technology::all('id', 'name')->toArray();
        return $data;
    }

    public function resetType($id)
    {
        $technology = Technology::find($id);
        $technology->type_id = null;
        $technology->save();
    }

    public function resetCategory($id)
    {
        $technology = Technology::find($id);
        $technology->technology_id = null;
        $technology->save();
    }


    public function treeData()
    {
//        return json_decode(Technology::getTreeData())->data;
        return Technology::getTreeData();
    }

}
