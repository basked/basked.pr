<?php

namespace Modules\Skill\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Skill\Entities\Language;
use Modules\Skill\Traits\TraitSkillDevModel;

class ApiLanguageController extends Controller
{

    use TraitSkillDevModel;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->getApiModel($request, Language::class);
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
            $language = new Language();
            $language->id = $request->id;
            $language->name = $request->name;
            $language->slug = Str::slug($request->name, '-');
            $language->descr = $request->descr;
            $language->save();
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
        $language = Language::find($id);
        $language->id = $request->id;
        $language->name = $request->name;
        $language->slug = Str::slug($request->name, '-');
        $language->descr = $request->descr;
        $language->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Language::destroy([$id]);
    }
}
