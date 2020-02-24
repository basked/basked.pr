<?php

namespace Modules\Skill\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Skill\Entities\Developer;
use Modules\Skill\Entities\Roadmap;
use Modules\Skill\Traits\TraitSkillDevModel;
use Illuminate\Support\Str;
use Validator;

class ApiRoadmapController extends Controller
{

    use TraitSkillDevModel;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->getApiModel($request, Roadmap::class, []);
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
            $roadmap = new Roadmap();
            $roadmap->id = $request->id;
            $roadmap->developer_id = $request->developer_id;
            $roadmap->name = $request->name;
            $roadmap->slug = Str::slug($request->name, '-');
            $roadmap->descr = $request->descr;
            $roadmap->save();
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
        $roadmap = Roadmap::find($id);
        $roadmap->update();
        $roadmap->id = is_null($request->id) ? $roadmap->id : $request->id;
        $roadmap->name = is_null($request->name) ? $roadmap->name : $request->name;
        $roadmap->slug = Str::slug(is_null($request->name) ? $roadmap->name : $request->name, '-');
        $roadmap->developer_id = is_null($request->developer_id) ? $roadmap->developer_id : $request->developer_id;
        $roadmap->descr = is_null($request->descr) ? $roadmap->descr : $request->descr;
        $roadmap->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Roadmap::destroy([$id]);
    }


    public function lookDevelopers()
    {
        $data['data'] = Developer::all('id', 'name')->toArray();
        return $data;
    }


    public function resetDeveloper(Request $request, $id)
    {
        //  dd($request->all());
        $roadmap = Roadmap::find($id);
        $roadmap->update();
        $roadmap->id = is_null($request->id) ? $roadmap->id : $request->id;
        $roadmap->name = is_null($request->name) ? $roadmap->name : $request->name;
        $roadmap->slug = Str::slug(is_null($request->slug) ? $roadmap->slug : $request->slug, '-');
        $roadmap->developer_id = null;
        $roadmap->descr = is_null($request->descr) ? $roadmap->descr : $request->descr;

        $roadmap->save();
    }
}
