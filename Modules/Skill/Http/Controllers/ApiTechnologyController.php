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

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->getApiModel($request, Technology::class);
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
            $technology->type_id = 1;
            $technology->descr = $request->descr;
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
        $technology = Technology::find($id);
        $technology ->id = $request->id;
        $technology->name = $request->name;
        $technology->slug = Str::slug($request->name, '-');
        $technology->type_id = 1;
        $technology->descr = $request->descr;
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


    public function types($id)
    {
        Technology::find($id)->type()->toJson();
    }
}
