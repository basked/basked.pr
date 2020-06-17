<?php

namespace Modules\Skill\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Modules\Skill\Entities\Developer;
use Modules\Skill\Traits\TraitSkillDevModel;
use Illuminate\Support\Str;
use Validator;

class ApiDeveloperController extends Controller
{
    use TraitSkillDevModel;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->getApiModel($request, Developer::class, []);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            // 'name' => 'required|unique:spr_countries,name',
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {
            $developer = new Developer();
            $developer->id = $request->id;
            $developer->name = $request->name;
            $developer->slug = Str::slug($request->name, '-');
            $developer->descr = $request->descr;
            $developer->save();
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
        $developer = Developer::find($id);
        $developer->id = is_null($request->id) ? $developer->id : $request->id;
        $developer->name = is_null($request->name) ? $developer->name : $request->name;
        $developer->slug = Str::slug(is_null($request->name) ? $developer->name : $request->name, '-');
        $developer->descr = is_null($request->descr) ? $developer->descr : $request->descr;
        $developer->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Developer::destroy([$id]);
    }



}
